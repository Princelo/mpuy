<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constants;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @Route("/product/view/{product_id}", name="product_view")
     * @param $product_id
     * @param Request $request
     * @return Response
     */
    public function productViewAction($product_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($product_id);
        $images = $em->getRepository('AppBundle:Image')->findBy(['product' => $product]);
        $user = $this->getUser();
        $avatar = $user->getAvatar();
        $nickname = $user->getNickName();
        $user = $this->getUser()->getId();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user);
        $isOwn = $product->getUser() == $user;
        $now = new \DateTime();
        $owner = $product->getUser();
        if (!$isOwn && !$user->isFollowing($owner)) {
            $owner->setFansCount($owner->getFansCount() + 1);
            $owner->addFansUser($user);
            $user->setFollowCount($user->getFollowCount() + 1);
            $user->addFollowedUser($owner);
            $em->persist($owner);
            $em->persist($user);
            $em->flush();
        }
        return $this->render('product/product_view.html.twig', array(
            'p' => $product,
            'third_user' => $product->getUser(),
            'self' => $user,
            'isOwn' => $isOwn,
            'is_expired' => $now >= $product->getExpireTime(),
        ));
    }

    /**
     * @Route("/product/random", name="product_random")
     * @param Request $request
     * @return Response
     */
    public function randomProductAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $cookies = $request->cookies;
        if ($cookies->has('random_category'))
            $randomCategory = $cookies->get('random_category');
        else
            $randomCategory = rand(0, 5);
        $randomProduct = $em->getRepository('AppBundle:Product')->getRandomProduct($randomCategory);
        // There may be no products belong to $randomCategory
        // Make sure that $randomProduct is not null by checking at most 100 times
        for ($i = 0; $i < 100; $i ++) {
            if (null == $randomProduct && !$cookies->has('random_category')) {
                $randomCategory = rand(0, 5);
                $randomProduct = $em->getRepository('AppBundle:Product')->getRandomProduct($randomCategory);
            } else {
                break;
            }
        }
        if (null == $randomProduct)
            return new Response('没有未过期商品');
        return $this->render('product/random_product.html.twig', array(
            'p' => $randomProduct,
            'category' => $cookies->has('random_category')?intval($cookies->get('random_category')):-1
        ));
    }

    /**
     * @param integer $id
     * @param Request $request
     * @Route("/product/list/user/{id}", name="user_product_list")
     * @return Response
     */
    public function userProductListAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('AcmeAccountBundle:User')->findOneBy(['id'=>$id]);
        $avatar = $user->getAvatar();
        $nickname = $user->getNickName();
        $products = $em->getRepository('AppBundle:Product')->getUserProducts($user, 0, Constants::PRODUCT_PER_PAGE);
        return $this->render('product/user_product_list.html.twig', array(
            'products' => $products,
            'third_user' => $user,
            'self'   => $this->getUser()
        ));
    }

}
