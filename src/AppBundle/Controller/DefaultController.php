<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constants;
use Doctrine\DBAL\Events;
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
        $test = new TestEvent();
        $em = $this->getDoctrine()->getEntityManager();
        $metadataFactory = $em->getMetadataFactory();
        $evm = $em->getEventManager();
        $evm->addEventListener(\Doctrine\ORM\Events::loadClassMetadata, $test);

        // replace this example code with whatever you need
        $user = $this->getUser();
        $avatar = $user->getAvatar();
        $nickname = $user->getNickName();
        $products = $em->getRepository('AppBundle:Product')->getHomeProducts($user, 0, Constants::PRODUCT_PER_PAGE);
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'avatar' => $avatar,
            'nickname' => $nickname,
            'products' => $products,
        ));
    }
}

class TestEvent
{
    public function loadClassMetadata(\Doctrine\ORM\Event\LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $fieldMapping = array(
            'fieldName' => 'about',
            'type' => 'string',
            'length' => 255
        );
        $classMetadata->mapField($fieldMapping);
    }
}
