<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

interface WechatTokenGetterInterface
{
    public function wechatLogin(FilterControllerEvent $event);
}