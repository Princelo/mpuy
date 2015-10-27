<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constants;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $user = $this->getUser();
        $avatar = $user->getAvatar();
        $nickname = $user->getNickName();
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('AppBundle:Product')->getHomeProducts($user, 0, Constants::PRODUCT_PER_PAGE);
        $payment = $em->getRepository('AppBundle:Payment')->getHighestPayment($products[0]);
        $bidList = $em->getRepository('AppBundle:Payment')->getBidList($products[0]);
        return new JsonResponse($bidList);
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'avatar' => $avatar,
            'nickname' => $nickname,
            'products' => $products,
        ));
    }
}
