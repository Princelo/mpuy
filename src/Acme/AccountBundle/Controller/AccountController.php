<?php
namespace Acme\AccountBundle\Controller;

use Acme\AccountBundle\Entity\User;
use AppBundle\Entity\Constants;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AccountController extends BaseController
{
    /**
     * @param Request $request
     * @return RedirectResponse
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            /*****************************************************
             * Add new functionality (e.g. log the registration) *
             *****************************************************/
            $this->container->get('logger')->info(
                sprintf('New user registration: %s', $user)
            );

            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $this->authenticateUser($user);
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);

            return new RedirectResponse($url);
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @param Request $request
     * @Route("/wechat_login", name="wechat_login")
     * @return RedirectResponse
     */
    public function wechatLoginAction(Request $request)
    {
        $code = $request->get('code');
        if ($code == null) {
            return $this->redirectToRoute('homepage');
        }
        $appId = Constants::APP_ID;
        $secret = Constants::APP_SECRET;
        $getTokenUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appId.'&secret='.$secret.'&code='
            .$code.'&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$getTokenUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec ($ch);
        curl_close ($ch);
        $jsonOutput = json_decode($serverOutput);
        if (!isset($jsonOutput->openid)) {
            return $this->redirectToRoute('homepage');
        }
        $openid = $jsonOutput->openid;
        $accessToken = $jsonOutput->access_token;
        //$accessToken = $request->getSession()->get('wechat_token');
        $getContentUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$accessToken.'&openid='.$openid.'&lang=zh_CN';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$getContentUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec ($ch);
        curl_close ($ch);
        $jsonOutput = json_decode($serverOutput);
        if (!isset($jsonOutput->openid)) {
            return $this->redirectToRoute('homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $repo  = $em->getRepository("AcmeAccountBundle:User"); //Entity Repository
        $user = $repo->loadUserByWechatOpenId($jsonOutput->openid);
        if (!$user) {
            $newUser = new User();
            $newUser->setWechatOpenId($jsonOutput->openid);
            $newUser->setNickname($jsonOutput->nickname);
            $newUser->setGender($jsonOutput->sex);
            $newUser->setCity($jsonOutput->city);
            $newUser->setProvince($jsonOutput->province);
            $newUser->setCountry($jsonOutput->country);
            $newUser->setAvatar($jsonOutput->headimgurl);
            $newUser->setPassword('no password');
            $newUser->setUsername($jsonOutput->openid);
            $newUser->setEmail($jsonOutput->openid.'@ct-life.cn');
            $em->persist($newUser);
            $em->flush();
        } else {
            $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());
            $this->get("security.context")->setToken($token); //now the user is logged in

            //now dispatch the login event
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            return $this->redirectToRoute('homepage');
        }
    }
}