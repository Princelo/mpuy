<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublishController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @Route("/publish/step1", name="publish_step1")
     */
    public function publishStep1Action(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/publish_step1.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
