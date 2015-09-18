<?php
namespace AppBundle\EventListener;

use AppBundle\Controller\WechatTokenGetterInterface;
use AppBundle\Entity\Constants;
use Doctrine\Common\Cache\PredisCache;
use Predis\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\Route;

class WechatTokenGetter
{
    /*private $tokens;

    public function __construct($tokens)
    {
        $this->tokens = $tokens;
    }*/

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof WechatTokenGetterInterface) {
            $session = $event->getRequest()->getSession();
            $redis = new Client();
            $wechat_token = json_decode($redis->get('wechat_token'));
            $now = new \DateTime();
            if ( intval($wechat_token->timestamp) + 7000 < intval($now->getTimestamp()) ) {
                $api_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".Constants::APP_ID."&secret=".Constants::APP_SECRET;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec ($ch);
                curl_close ($ch);
                $json_output = json_decode($server_output);

                $api_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$json_output->access_token}&type=jsapi";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec ($ch);
                curl_close ($ch);
                $json_output_ticket = json_decode($server_output);

                $redis->del('wechat_token');

                $wechat_token_json = json_encode([
                    'wechat_token'=>$json_output->access_token,
                    'timestamp'=>$now->getTimestamp(),
                    'wechat_jsticket' => $json_output_ticket->ticket
                    ]);
                $redis->set('wechat_token', $wechat_token_json);
                $session->set('wechat_token', $json_output->access_token);
                $session->set('wechat_jsticket', $json_output_ticket->ticket);
                $session->set('noncestr', mt_rand());
                $session->set('wechat_timestamp', $now->getTimestamp());
            } else {
                $session->set('wechat_token', json_decode($redis->get('wechat_token'))->wechat_token);
                $session->set('wechat_jsticket', json_decode($redis->get('wechat_token'))->wechat_jsticket);
                if (!$session->has('noncestr')) {
                    $session->set('noncestr', mt_rand());
                }
                if (!$session->has('wechat_timestamp')) {
                    $session->set('wechat_timestamp', $now->getTimestamp());
                }
            }

            $url = $event->getRequest()->getSchemeAndHttpHost();
            $url .= $event->getRequest()->getRequestUri();

            $string1 = "jsapi_ticket=".$session->get('wechat_jsticket')."&noncestr=".$session->get('noncestr')
                ."&timestamp=".$session->get('wechat_timestamp')."&url=".$url;
            $signature = sha1($string1);
            $session->set('signature', $signature);
        }
    }
}