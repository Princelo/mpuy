<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 9/22/15
 * Time: 11:33
 */
namespace AppBundle\Command;

use AppBundle\Entity\AuctionOrder;
use AppBundle\Entity\Constants;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OrderCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('order_create:command')
            ->setDescription('Create Orders')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $now = new \DateTime('now');
        $products = $em->getRepository('AppBundle:Product')->getProductsExpired($now);
        foreach($products as $i => $p) {
            if ($p->getTopPayment() === null) {
            } else {
                $order = new AuctionOrder();
                $order->setProduct($p);
                $order->setPayment($p->getTopPayment());
                $order->setBuyer($p->getTopPayment()->getPayUser());
                $order->setSeller($p->getUser());
                $order->setIsDelete(false);
                $order->setOrderSn($now->format('YmdHis').sprintf("%04s", $i));
                $order->setStatus(Constants::ORDER_CREATE);
                $order->setPayStatus(Constants::ORDER_NON_PAY);
                $em->persist($order);
                $p->setHasGeneratedOrder(true);
                $em->persist($p);
                $em->flush();
            }
        }
    }
}