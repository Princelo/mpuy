<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constants;
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
            exit('not ajax');
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
            $payment = new Payment();
            $payment->setPayUser($this->getUser());
            $payment->setRecieveUser($product->getUser());
            $payment->setVolume($volume);
            $payment->setPayTime(new \DateTime());
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
            exit('not ajax');
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
            exit('not ajax');
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
            exit('not ajax');
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
            exit('not ajax');
        }
        $thirdUserId = $request->request->get('user_id');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $thirdUser = $em->getRepository('AcmeAccountBundle:User')->find($thirdUserId);
        $user->addFollowedUser($thirdUser);
        $em->persist($user);
        $em->flush();
    }

    /**
     * @param Request $request
     * @Route("/ajax/unfollow", name="ajax_unfollow")
     */
    public function ajaxUnfollowAction(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit('not ajax');
        }
        $thirdUserId = $request->request->get('user_id');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $thirdUser = $em->getRepository('AcmeAccountBundle:User')->find($thirdUserId);
        $user->removeFollowedUser($thirdUser);
        $em->persist($user);
        $em->flush();
    }

    /**
     * @Route("/ajax/get_bid_list", name="ajax_get_bid_list")
     */
    public function ajaxGetBidList(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit('not ajax');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $productId = $request->request->get('product_id');
        $product = $em->getRepository('AppBundle:Product')->find($productId);
        $expireTime = $product->getExpireTime();
        $now = new \DateTime();
        if ($now >= $expireTime) {
            return new JsonResponse(
                'ended'
            );
        }
        $bidList = $em->getRepository('AppBundle:Payment')->getBidList($product);
        return new JsonResponse($bidList);
    }
}
