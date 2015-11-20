<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 9/22/15
 * Time: 11:33
 */
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WechatMessageSenderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wechat_message_sender:command')
            ->setDescription('Send Message By Wechat')
            ->addArgument(
                'accesstoken',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'openid',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'ordersn',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'volume',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'mobile',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'productname',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'objectname',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'orderid',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'object',
                InputArgument::REQUIRED
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $accessToken = substr($input->getArgument('accesstoken'), 1);
        $apiUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
        $openId = substr($input->getArgument('openid'), 1);
        $orderSn = $input->getArgument('ordersn');
        $volume = $input->getArgument('volume');
        $mobile = $input->getArgument('mobile');
        $productName = $input->getArgument('productname');
        $objectName = $input->getArgument('objectname');
        $orderId = $input->getArgument('orderid');
        $object = $input->getArgument('object');
        $router = $this->getContainer()->get('router')->getContext();
        $orderUrl = $router->generateUrl('order_details', ['id' => $orderId]);
        if ($object == 'forBuyer') {
            $postData = '{
               "touser":"'.$openId.'",
               "template_id":"DbSMq1Qp6tezIcJUK4HpEPRUyxgEXJlnLisYXHImIVw",
               "url":"",
               "data":{
                       "first": {
                           "value":"恭喜您竞拍成功！",
                           "color":"#173177"
                       },
                       "orderID":{
                           "value":"'.$orderSn.'",
                           "color":"#173177"
                       },
                       "orderMoneySum": {
                           "value":"'.$volume.'元",
                           "color":"#173177"
                       },
                       "backupFieldName": {
                           "value":"竞拍商品",
                           "color":"#173177"
                       },
                       "backupFieldName":{
                           "value":"'.$productName.'！",
                           "color":"#173177"
                       },
                       "remark": {
                           "value":"请联系卖主'.$objectName.'(手机号:'.$mobile.')",
                           "color":"#173177"
                       }
               }
            }';
        } elseif ($object == 'forSeller') {
            $postData = '{
               "touser":"'.$openId.'",
               "template_id":"DbSMq1Qp6tezIcJUK4HpEPRUyxgEXJlnLisYXHImIVw",
               "url":"",
               "data":{
                       "first": {
                           "value":"恭喜您的拍品竞拍成功！",
                           "color":"#173177"
                       },
                       "orderID":{
                           "value":"'.$orderSn.'",
                           "color":"#173177"
                       },
                       "orderMoneySum": {
                           "value":"'.$volume.'元",
                           "color":"#173177"
                       },
                       "backupFieldName": {
                           "value":"竞拍商品",
                           "color":"#173177"
                       },
                       "backupFieldName":{
                           "value":"'.$productName.'！",
                           "color":"#173177"
                       },
                       "remark": {
                           "value":"请联系拍家'.$objectName.'(手机号:'.$mobile.')",
                           "color":"#173177"
                       }
               }
            }';
        }
        $this->sendPostData($apiUrl, $postData);
    }

    function sendPostData($url, $post){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);  // Seems like good practice
        return $result;
    }

}