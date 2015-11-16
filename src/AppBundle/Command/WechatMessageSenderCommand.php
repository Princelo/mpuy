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
                'serverid',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'imageid',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'accesstoken',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'basedir',
                InputArgument::REQUIRED
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $accessToken = substr($input->getArgument('accesstoken'), 1);
        $apiUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
        $openId = substr($input->getArgument('openid'), 1);
        $postData = '{
           "touser":"'.$openId.'",
           "template_id":"ngqIpbwh8bUfcSsECmogfXcV14J0tQlEpBO27izEYtY",
           "url":"http://weixin.qq.com/download",
           "data":{
                   "first": {
                       "value":"恭喜你购买成功！",
                       "color":"#173177"
                   },
                   "keynote1":{
                       "value":"巧克力",
                       "color":"#173177"
                   },
                   "keynote2": {
                       "value":"39.8元",
                       "color":"#173177"
                   },
                   "keynote3": {
                       "value":"2014年9月22日",
                       "color":"#173177"
                   },
                   "remark":{
                       "value":"欢迎再次购买！",
                       "color":"#173177"
                   }
           }
       }';
    }
}