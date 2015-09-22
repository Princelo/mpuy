<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constants;
use AppBundle\Entity\Image;
use AppBundle\Entity\Product;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\PessimisticLockException;
use JMS\JobQueueBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/publish/step1/submit", name="publish_step1_submit")
     */
    public function publishStep1SubmitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName($request->request->get('name'));
        $product->setIntro($request->request->get('description'));
        $user = $this->getUser()->getId();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user);
        $product->setUser($user);
        $em->persist($product);
        $em->flush();
        $localIds = $request->request->get('localId');
        foreach ($request->request->get('serverId') as $k => $v) {
            if (isset($v) && $v != '') {
                $image = new Image();
                $image->setProduct($product);
                $image->setLocalId($localIds[$k]);
                $image->setServerId($v);
                $em->persist($image);
                $em->flush();
                $this->saveWechatImageAsync($v, $image->getId(), $request->getSession()->get('wechat_token'));
            }
        }
        $em->flush();
        $productId = $product->getId();
        return $this->redirectToRoute('publish_step2', ['product_id' => $productId]);
    }

    public function saveWechatImageAsync($serverId, $imageId, $accessToken)
    {
        $base_dir = realpath($this->container->getParameter('kernel.root_dir').'/..');
        $job = new Job('jms_job_queue_runner:command', [$serverId, $imageId, $accessToken, $base_dir]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($job);
        $em->flush();
    }

    /**
     * @Route("/publish/step2/{product_id}", name="publish_step2")
     */
    public function publishStep2Action(Request $request, $product_id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user);
        if ($em->getRepository('AppBundle:Product')->find($product_id)->getUser() !=
            $user) {
            throw new PessimisticLockException(
                sprintf(
                    'Product find by Id "%s" is not the current user\'s.', $product_id
                )
            );
        }
        // replace this example code with whatever you need
        return $this->render('default/publish_step2.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/publish/step2/submit", name="publish_step2_submit")
     */
    public function publishStep2SubmitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user);
        $product = $em->getRepository('AppBundle:Product')->find($request->request->get('product_id'));
        if ($product->getUser() != $user) {
            throw new PessimisticLockException(
                sprintf(
                    'Product find by Id "%s" is not the current user\'s.', $request->request->get('product_id')
                )
            );
        }
        $product->setCategory($request->request->get('category'));
        $product->setExpireTime($request->request->get('expire_time'));
        $product->setFixedPrice($request->request->get('fixed_price'));
        $product->setIsFreePostage($request->request->get('is_free_postage'));
        $product->setReferencePrice($request->request->get('reference_price'));
        $product->setStartPrice($request->request->get('start_price'));
        $product->setStepPrice($request->request->get('step_price'));
        $em->persist($product);
        $em->flush();
        return new Response('pushlish complete');
        return $this->redirectToRoute('product_view', ['product_id' => $request->request->get('product_id')]);
    }

}
