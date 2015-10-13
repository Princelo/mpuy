<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @Route("/payment/bid", name="payment_bid")
     */
    public function paymentBidAction(Request $request)
    {
        $productId = $request->query->get('product_id');
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('AppBundle:Product')->find($productId);
        return $this->render('default/publish_step1.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

}
