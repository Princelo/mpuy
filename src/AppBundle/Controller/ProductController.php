<?php

namespace AppBundle\Controller;

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
        return $this->render('product/product_view.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'p' => $product,
            'images' => $images,
            'avatar' => $avatar,
            'nickname' => $nickname,
            'isOwn' => $isOwn,
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
        $randomCategory = rand(0, 5);
        $randomProduct = $em->getRepository('AppBundle:Product')->getRandomProduct($randomCategory);
        echo "<pre>";
        print_r($randomProduct);exit;
        $images = $em->getRepository('AppBundle:Image')->findBy(['product' => $randomProduct]);
        $user = $this->getUser();
        $avatar = $user->getAvatar();
        $nickname = $user->getNickName();
        $user = $this->getUser()->getId();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user);
        $owner = $randomProduct->getUser();
        $isOwn = $owner == $user;
        if (!$isOwn) {
            $owner->setFansCount($owner->getFansCount() + 1);
            $owner->addFansUsers($user);
            $user->setFollowCount($user->getFollowCount() + 1);
            $user->addFollowedUser($owner);
            $em->persist($owner);
            $em->persist($user);
            $em->flush();
        }
        return $this->render('product/product_view.html.twig', array(
            'p' => $randomProduct,
            'images' => $images,
            'avatar' => $avatar,
            'nickname' => $nickname,
            'isOwn' => $isOwn,
        ));
    }
}
