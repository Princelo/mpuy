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
        $em = $this->getDoctrine()->getEntityManager();
        $page = 1;
        $offset = $page * Constants::PRODUCT_PER_PAGE;
        $products = $em->getRepository('AppBundle:Product')
            ->getHomeProducts($this->getUser(), $offset, Constants::PRODUCT_PER_PAGE);
        $template = $this->renderView('default/index-ajax-template.html.twig', ['products' => $products]);
        echo '<pre>';
        print_r($template);
        exit;
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'avatar' => $avatar,
            'nickname' => $nickname,
            'products' => $products,
        ));
    }
}
