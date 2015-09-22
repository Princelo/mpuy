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
        $url = $argv[0];
        file_put_contents("/mnt/html/mpuy/web/attachments/wechat_img/".uniqid(), fopen($url, 'r'));
    }
}