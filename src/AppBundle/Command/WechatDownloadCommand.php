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

class WechatDownloadCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jms_job_queue_runner:command')
            ->setDescription('Download Images from Wechat Server')
            ->addArgument(
                'serverid',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addArgument(
                'imageid',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addArgument(
                'accesstoken',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addArgument(
                'basedir',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $serverId = $input->getArgument('serverid');
        $accessToken = $input->getArgument('accesstoken');
        $basedir = $input->getArgument('basedir');
        $imageId = $input->getArgument('imageid');
        file_put_contents($basedir."/web/attachments/wechat_img/".$imageId, fopen("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$accessToken."&media_id=".$serverId, 'r'));
    }
}