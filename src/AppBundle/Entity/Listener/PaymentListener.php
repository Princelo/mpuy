<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/12/15
 * Time: 14:43
 */
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\Message;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Payment;

class PaymentListener
{
    public function prePersist(Payment $payment, LifecycleEventArgs $event)
    {
        if ($payment->getId() !== null) {
            $product = $payment->getProduct();
            $exPayment = $product->getTopPayment();
            $product->setTopPayment($payment);
            // Implement all logic needed in order to send a welcome email...
            $em = $event->getEntityManager();
            $em->persist($product);
            $messageForPayer = new Message();
            $messageForExPayer = new Message();
            $messageForReceiver = new Message();
            $messageForPayer->setContext('您拍了'.$product->getName().'商品, 拍价为'.$payment->getVolume().'元');
            $messageForPayer->setIsLinkProduct(true);
            $messageForPayer->setLinkProduct($product);
            $em->persist($messageForPayer);
            if ($exPayment !== null) {
                $messageForPayer->setReceiveUser($exPayment->getPayUser());
                $messageForExPayer->setContext('您用'.$exPayment->getVolume().'元拍的'.$product->getName().'商品, 被'.$payment->getVolume().'元拍价超越了');
                $messageForExPayer->setIsLinkProduct(true);
                $messageForExPayer->setLinkProduct($product);
                $em->persist($messageForExPayer);
            }
            $messageForReceiver->setContext($payment->getPayUser()->getNickName().'拍了您的'.$product->getName().'商品, 拍价为'.$payment->getVolume().'元');
            $messageForReceiver->setIsLinkProduct(true);
            $messageForReceiver->setLinkProduct($product);
            $em->persist($messageForReceiver);
            $em->flush();
        }
    }
}