<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @Route("/message/mine", name="message_mine")
     */
    public function messageMineAction(Request $request)
    {
        $user = $this->getUser();
    }

}
