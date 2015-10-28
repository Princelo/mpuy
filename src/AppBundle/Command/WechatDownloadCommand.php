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
        $serverId = substr($input->getArgument('serverid'), 1);
        $accessToken = substr($input->getArgument('accesstoken'), 1);
        $basedir = $input->getArgument('basedir');
        $imageId = $input->getArgument('imageid');
        file_put_contents($basedir."/web/attachments/wechat_img/".$imageId, fopen("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$accessToken."&media_id=".$serverId, 'r'));
    }
}