<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/12/15
 * Time: 14:43
 */
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\Constants;
use AppBundle\Entity\Message;
use AppBundle\Entity\ProductEvent;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Product;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\PostUpdate;

class ProductListener
{
    public function postUpdate(Product $product, LifecycleEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Product) {
            if ($product->getIsActive() == true && $product->getEvents()->isEmpty()) {
                $productEvent = new ProductEvent();
                $productEvent->setActionUser($eventArgs->getEntity()->getUser());
                $productEvent->setProduct($eventArgs->getEntity());
                $productEvent->setType(Constants::EVENT_PRODUCT_PUBLISH);
                $em = $eventArgs->getEntityManager();
                $em->persist($productEvent);
                $em->flush();
            }
        }
    }
}