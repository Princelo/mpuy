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

    /**
     * @Route("/message/details/{id}", name="message_details")
     */
    public function messageDetailsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $message = $em->getRepository('AppBundle:Message')->find($id);
        $message->setIsRead(true);
        $em->persist($message);
        $em->flush();
        return $this->render('message/details.html.twig', array(
            'message' => $message,
        ));
    }

}
