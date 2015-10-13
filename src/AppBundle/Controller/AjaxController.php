<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/bid_send", name="bid_send")
     */
    public function bidSendAction(Request $request)
    {
        if ( !$request->isXmlHttpRequest() ) {
            exit;
        }
        $volume = $request->request->get('volume');
        $product_id = $request->request->get('product_id');

    }
}
