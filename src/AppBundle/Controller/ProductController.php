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
        return $this->render('product/product_view.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
