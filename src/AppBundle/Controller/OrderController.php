<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Constants;
use Doctrine\ORM\PessimisticLockException;

class OrderController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @Route("/order/bought/{type}", name="order_bought", defaults={"type" = ""})
     * @param $type
     * @param Request $request
     * @return Response
     */
    public function orderBoughtListAction($type, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        switch ($type) {
            case '':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders($user, null, Constants::ORDER_PER_PAGE, 0, 'id desc');
                break;
            case 'paying':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders($user, null, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 1);
                break;
            case 'delivering':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders($user, null, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 2);
                break;
            case 'receiving':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders($user, null, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 3);
                break;
            case 'finish':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders($user, null, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 0);
                break;
            default :
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders($user, null, Constants::ORDER_PER_PAGE, 0, 'id desc');
                break;
        }
        return $this->render('order/bought_list.html.twig', array(
            'title' => '我的已买拍品',
            'orders' => $orderList,
        ));
    }

    /**
     * @Route("/order/sold/{type}", name="order_sold", defaults={"type" = ""})
     * @param $type
     * @param Request $request
     * @return Response
     */
    public function orderSoldListAction($type, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        switch ($type) {
            case '':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders(null, $user, Constants::ORDER_PER_PAGE, 0, 'id desc');
                break;
            case 'paying':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders(null, $user, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 1);
                break;
            case 'delivering':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders(null, $user, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 2);
                break;
            case 'receiving':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders(null, $user, Constants::ORDER_PER_PAGE, 0,
                    'id desc', 3);
                break;
            case 'finish':
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders(null, $user, Constants::ORDER_PER_PAGE, 0,
                    'id desc', [0, -1]);
                break;
            default :
                $orderList = $em->getRepository('AppBundle:AuctionOrder')->getOrders(null, $user, Constants::ORDER_PER_PAGE, 0, 'id desc');
                break;
        }
        return $this->render('order/sold_list.html.twig', array(
            'title' => '我的已卖拍品',
            'orders' => $orderList,
        ));
    }

    /**
     * @Route("/order/details/{order_id}", name="order_details")
     * @param $order_id
     * @param Request $request
     * @return Response
     * @throws PessimisticLockException
     */
    public function orderDetailsAction($order_id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $user = $user->getId();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user);
        $order = $em->getRepository('AppBundle:AppBundle:AuctionOrder')->find($order_id);
        if ($order->getBuyer() != $user && $order->getSeller() != $user) {
            throw new PessimisticLockException(
                sprintf(
                    'Order find by Id "%s" has none business of the current user.', $order_id
                )
            );
        }
        $events = $em->getRepository('ProductEvent')->getEvents($order->getProduct(), $order);
        return $this->render('order/details.html.twig', array(
            'title' => '订单详情',
            'order' => $order,
            'events' => $events,
        ));
    }

}
