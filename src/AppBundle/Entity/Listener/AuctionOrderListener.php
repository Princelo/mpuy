<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/12/15
 * Time: 14:43
 */
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\AuctionOrder;
use AppBundle\Entity\Constants;
use AppBundle\Entity\Message;
use AppBundle\Entity\ProductEvent;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Payment;
use JMS\JobQueueBundle\Entity\Job;

class AuctionOrderListener
{
    public function postPersist(AuctionOrder $order, LifecycleEventArgs $event)
    {
        if ($order->getId() !== null) {
            $em = $event->getEntityManager();
            $productEvent = new ProductEvent();
            $productEvent->setProduct($order->getProduct());
            $productEvent->setActionUser($order->getProduct()->getTopPayment()->getPayUser());
            $productEvent->setType(Constants::EVENT_ORDER_INIT);
            $productEvent->setOrder($order);
            $em->persist($productEvent);
            $em->flush();
            $buyer = $order->getProduct()->getTopPayment()->getPayUser();
            $seller = $order->getProduct()->getUser();
            $session = $this->container->get('session');
            $accessToken = 'a'.$session->get('wechat_token');
            $ownerOpenId = $seller->getWechatOpenId();
            $buyerOpenId = $buyer->getWechatOpenId();
            $orderId = $order->getId();
            $orderSn = $order->getOrderSn();
            $volume = $order->getProduct()->getTopPayment()->getVolume();
            $productName = $order->getProduct()->getName();
            $ownerMobile = $seller->getMobile();
            $buyerMobile = $buyer->getMobile();
            $this->sendWechatMessageAsync([
                'access_token' => $accessToken,
                'open_id'  => 'a'.$ownerOpenId,
                'order_sn' => $orderSn,
                'volume'  => $volume,
                'mobile'  => $ownerMobile,
                'product_name' => $productName,
                'object_name'  => $seller->getNickname(),
                'order_id' => $orderId,
            ], 'forSeller');
            $this->sendWechatMessageAsync([
                'access_token' => $accessToken,
                'open_id'  => 'a'.$buyerOpenId,
                'order_sn' => $orderSn,
                'volume'   => $volume,
                'mobile'   => $buyerMobile,
                'product_name' => $productName,
                'object_name'  => $buyer->getNickname(),
                'order_id' => $orderId
            ], 'forBuyer');
            $this->sendSiteMessage($order, $em);
        }
    }

    public function sendWechatMessageAsync($arr, $object)
    {
        $job = new Job('wechat_message_sender:command', [
            $arr['access_token'],
            $arr['open_id'],
            $arr['order_sn'],
            $arr['volume'],
            $arr['mobile'],
            $arr['product_name'],
            $arr['object_name'],
            $arr['order_id'],
            $object
        ]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($job);
        $em->flush();
    }

    public function sendSiteMessage($order, $em)
    {
        $messageForPayer = new Message();
        $messageForReceiver = new Message();
        $messageForPayer->setContext('您竞拍成功了'.$order->getProduct()->getName().'商品, 拍价为'.$order->getProduct()->getTopPayment()->getVolume().'元');
        $messageForPayer->setIsLinkOrder(true);
        $messageForPayer->setLinkOrder($order);
        $messageForPayer->setReceiveUser($order->getProduct()->getTopPayment()->getPayUser());
        $em->persist($messageForPayer);

        $messageForReceiver->setContext($order->getProduct()->getTopPayment()->getPayUser()->getNickName().'成功竞拍了您的'.$order->getProduct()->getName().'商品, 拍价为'.$order->getProduct()->getTopPayment()->getVolume().'元');
        $messageForReceiver->setIsLinkOrder(true);
        $messageForReceiver->setLinkOrder($order);
        $messageForReceiver->setReceiveUser($order->getProduct()->getUser());
        $em->persist($messageForReceiver);
        $em->flush();
    }
}