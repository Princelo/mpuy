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

class MessageListener
{
    public function postPersist(Message $message, LifecycleEventArgs $event)
    {
        if ($message->getId() !== null) {
            $em = $event->getEntityManager();
            $user = $message->getReceiveUser();
            $user->setMessageUnreadCount($user->getMessageUnreadCount() + 1);
            $user->setMessageCount($user->getMessageCount() + 1);
            $em->persist($user);
        }
    }
}