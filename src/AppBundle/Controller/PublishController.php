<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Entity\Product;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\PessimisticLockException;
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
        $product = new Product();
        $product->setName($request->query('name'));
        $product->setIntro($request->query('description'));
        $product->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        foreach ($request->query('images') as $k => $v) {
            $image = new Image();
            $image->setProduct($product);
            $image->setLocalId($v['localId']);
            $image->setServerId($v['localId']);
            $em->persist($image);
        }
        $em->flush();
        $productId = $product->getId();
        return $this->redirectToRoute('publish_step2', ['product_id' => $productId]);
    }

    /**
     * @Route("/publish/step2/{product_id}", name="publish_step2")
     */
    public function publishStep2Action(Request $request, $product_id)
    {
        $em = $this->getDoctrine()->getManager();
        if ($em->getRepository('AppBundle:Product')->find($product_id)->getUser() !=
            $this->getUser()) {
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
        $product = $em->getRepository('AppBundle:Product')->find($request->query('product_id'));
        if ($product->getUser() != $this->getUser()) {
            throw new PessimisticLockException(
                sprintf(
                    'Product find by Id "%s" is not the current user\'s.', $request->query('product_id')
                )
            );
        }
        $product->setCategory($request->query('category'));
        $product->setExpireTime($request->query('expire_time'));
        $product->setFixedPrice($request->query('fixed_price'));
        $product->setIsFreePostage($request->query('is_free_postage'));
        $product->setReferencePrice($request->query('reference_price'));
        $product->setStartPrice($request->query('start_price'));
        $product->setStepPrice($request->query('step_price'));
        $em->persist($product);
        $em->flush();
        return new Response('pushlish complete');
        return $this->redirectToRoute('product_view', ['product_id' => $request->query('product_id')]);
    }

}
