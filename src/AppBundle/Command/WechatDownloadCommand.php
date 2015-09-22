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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argv = $input->getArguments();
        $serverId = $argv[0];
        $accessToken = $argv[2];
        file_put_contents($argv[3]."/web/attachments/wechat_img", fopen("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$accessToken."&media_id=".$serverId, 'r'));
    }
}