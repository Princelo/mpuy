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

class ProductListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Product) {
            if ($eventArgs->hasChangedField('isActive') && $eventArgs->getNewValue('isActive') == true) {
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