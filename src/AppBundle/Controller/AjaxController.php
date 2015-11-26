<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constants;
use AppBundle\Entity\Message;
use AppBundle\Entity\Payment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/bid_send", name="ajax_bid_send")
     */
    public function bidSendAction(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        try {
            $em = $this->getDoctrine()->getEntityManager();
            $volume = $request->request->get('volume');
            $productId = $request->request->get('product_id');
            $product = $em->getRepository('AppBundle:Product')->find($productId);
            $stepPrice = $product->getStepPrice();
            $startPrice = $product->getStartPrice();
            $expireTime = $product->getExpireTime();
            $now = new \DateTime();
            if ($now->getTimestamp() >= $expireTime->getTimestamp()) {
                return new JsonResponse(
                    [
                        'state' => 'error',
                        'type' => 'ended',
                        'message' => '该拍卖已过期',
                    ]
                );
            }
            $highestPayment = $em->getRepository('AppBundle:Payment')->getHighestPayment($product);
            if ( $highestPayment === null ) {
                if ($volume < $startPrice) {
                    return new JsonResponse(
                        [
                            'state' => 'error',
                            'type' => 'volume',
                            'message' =>
                                '请确保您的出价在 起步价 ￥'. $startPrice .'元 以上'
                        ]
                    );
                }
            } elseif ($volume < $highestPayment->getVolume() + $stepPrice) {
                return new JsonResponse(
                    [
                        'state' => 'error',
                        'type' => 'volume',
                        'message' => '当前最高出价为 ￥'.$highestPayment->getVolume().'元 , 步价为 ￥'. $stepPrice .'元 ,请'.
                            '确保您的出价在 ￥'. bcadd($highestPayment->getVolume(), $stepPrice) .'元 以上'
                    ]
                );
            }
            $user = $em->getRepository('AcmeAccountBundle:User')->find($this->getUser()->getId());
            $payment = new Payment();
            $payment->setPayUser($user);
            $payment->setReceiveUser($product->getUser());
            $payment->setVolume($volume);
            $payment->setPayTime(new \DateTime());
            $payment->setProduct($product);
            $payment->setType(0);

            $em->persist($payment);
            $em->flush();
            return new JsonResponse(['state' => 'success']);
        } catch (Exception $e) {
            return new JsonResponse(['state' => 'error', 'type' => 'unknown']);
        }
    }

    /**
     * @Route("/ajax/like_send", name="ajax_like_send")
     */
    public function likeSendAction(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        try {
            $em = $this->getDoctrine()->getEntityManager();
            $productId = $request->request->get('product_id');
            $product = $em->getRepository('AppBundle:Product')->find($productId);
            $product->setLikeCount($product->getLikeCount() + 1);
            $product->addLikeUser($this->getUser());
            $em->persist($product);
            $em->flush();
            return new JsonResponse(['state' => 'success']);
        } catch (Exception $e) {
            return new JsonResponse(['state' => 'error']);
        }
    }

    /**
     * @Route("/ajax/get_following_users", name="ajax_get_following_users")
     */
    public function getFollowingUsers(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $page = $request->query->get('page');
        $perPage = Constants::USER_PER_PAGE;
        $offset = $perPage * $page - 1;
        $limit = $perPage;
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $em->getRepository('AccountBundle:User')->getFollowingUsersByUser($user, $offset, $limit);
    }

    /**
     * @Route("/ajax/get_followed_users", name="ajax_get_followed_users")
     */
    public function getFollowedUsers(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $page = $request->query->get('page');
        $perPage = Constants::USER_PER_PAGE;
        $offset = $perPage * $page - 1;
        $limit = $perPage;
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $em->getRepository('AccountBundle:User')->getFollowedUsersByUser($user, $offset, $limit);
    }

    /**
     * @param Request $request
     * @Route("/ajax/follow", name="ajax_follow")
     */
    public function ajaxFollowAction(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $thirdUserId = $request->request->get('user_id');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $thirdUser = $em->getRepository('AcmeAccountBundle:User')->find($thirdUserId);
        if (!$user->isFollowing($thirdUser)) {
            $user->setFollowCount($user->getFollowCount() + 1);
            $thirdUser->setFansCount($thirdUser->getFansCount() + 1);
            $user->addFollowedUser($thirdUser);
            $thirdUser->addFansUser($user);
            $em->persist($user);
            $em->persist($thirdUser);
            $em->flush();
        }
        return new JsonResponse('nothing');
    }

    /**
     * @param Request $request
     * @Route("/ajax/unfollow", name="ajax_unfollow")
     */
    public function ajaxUnfollowAction(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $thirdUserId = $request->request->get('user_id');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $thirdUser = $em->getRepository('AcmeAccountBundle:User')->find($thirdUserId);
        if ($user->isFollowing($thirdUser)) {
            $user->removeFollowedUser($thirdUser);
            $user->setFollowCount($user->getFollowCount() - 1);
            $thirdUser->setFansCount($thirdUser->getFansCount() - 1);
            $thirdUser->removeFansUser($user);
            $em->persist($user);
            $em->persist($thirdUser);
            $em->flush();
        }
        return new JsonResponse('nothing');
    }

    /**
     * @Route("/ajax/get_bid_list", name="ajax_get_bid_list")
     */
    public function ajaxGetBidList(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $em = $this->getDoctrine()->getEntityManager();
        $productId = $request->request->get('product_id');
        $product = $em->getRepository('AppBundle:Product')->find($productId);
        $expireTime = $product->getExpireTime();
        $now = new \DateTime();
        if ($now->getTimestamp() >= $expireTime->getTimestamp()) {
            return new JsonResponse(
                'ended'
            );
        }
        $bidList = $em->getRepository('AppBundle:Payment')->getBidList($product);
        return new JsonResponse($bidList);
    }

    /**
     * @Route("/ajax/get_home_products", name="ajax_get_home_products")
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxHomeProducts(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $page = $request->query->get('page');
        $em = $this->getDoctrine()->getEntityManager();
        $offset = $page * Constants::PRODUCT_PER_PAGE;
        $products = $em->getRepository('AppBundle:Product')
            ->getHomeProducts($this->getUser(), $offset, Constants::PRODUCT_PER_PAGE);
        $template = $this->renderView('default/index-ajax-template.html.twig', ['products' => $products]);
        return new JsonResponse([
            'html' => $template,
            'count' => count($products),
            'per' => Constants::PRODUCT_PER_PAGE,
        ]);
    }

    /**
     * @Route("/ajax/get_user_products/{id}", name="ajax_get_user_products")
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxUserProducts($id, Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $page = $request->query->get('page');
        $em = $this->getDoctrine()->getEntityManager();
        $offset = $page * Constants::PRODUCT_PER_PAGE;
        $user = $em->getRepository('AcmeAccountBundle:User')->findOneBy(['id'=>$id]);
        $products = $em->getRepository('AppBundle:Product')
            ->getUserProducts($user, $offset, Constants::PRODUCT_PER_PAGE);
        $template = $this->renderView('default/index-ajax-template.html.twig', ['products' => $products]);
        return new JsonResponse([
            'html' => $template,
            'count' => count($products),
            'per' => Constants::PRODUCT_PER_PAGE,
        ]);
    }

    /**
     * @Route("/ajax/check_mobile", name="ajax_check_mobile")
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxCheckMobile(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $user = $this->getUser();
        if ($user->getMobile() == null) {
            return new JsonResponse([
                'state' => 'error',
                'desc'  => 'mobile_null'
            ]);
        } else {
            return new JsonResponse([
                'state' => 'success',
            ]);
        }
    }

    /**
     * @Route("/ajax/set_mobile", name="ajax_set_mobile")
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxSetMobile(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit();
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $mobile = $request->request->get('mobile');
        $isExists = $em->getRepository('AcmeAccountBundle:User')->findOneBy(['mobile'=>$mobile]) !== null;
        if ($isExists) {
            return new JsonResponse([
                'state' => 'error',
                'desc'  => 'mobile_unique'
            ]);
        } else {
            $user->setMobile($mobile);
            $em->persist($user);
            $em->flush();
            return new JsonResponse([
                'state' => 'success',
            ]);
        }
    }

}
