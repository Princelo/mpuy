<?php
namespace Acme\AccountBundle\Controller;

use Acme\AccountBundle\Entity\User;
use AppBundle\Controller\WechatTokenGetterInterface;
use AppBundle\Entity\Constants;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller implements WechatTokenGetterInterface
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/profile", name="profile")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findBy(
                ['user' => $user, 'isActive'=>true],
                ['id' => 'DESC'],
                5);
        $likes = $em->getRepository('AppBundle:Product')->getLikedProducts($user, 5);

        return $this->render('user/profile.html.twig', array(
            'user' => $user,
            'products' => $products,
            'likes' => $likes,
        ));
    }

    /**
     * @Route("/profile/following_users", name="list_following_users")
     * @param Request $request
     * @return Response
     */
    public function listFollowingUsersAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $users = $em->getRepository('AcmeAccountBundle:User')->getFollowingUsersByUser($user, 0, 10);
        return $this->render('user/list_following_users.html.twig', array(
            'title' => '我的粉丝',
            'user' => $user,
            'users' => $users,
        ));
    }

    /**
     * @Route("/profile/followed_users", name="list_followed_users")
     * @param Request $request
     * @return Response
     */
    public function listFollowedUsersAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $users = $em->getRepository('AcmeAccountBundle:User')->getFollowedUsersByUser($user, 0, 10);
        return $this->render('user/list_followed_users.html.twig', array(
            'title' => '我的关注',
            'user' => $user,
            'users' => $users,
        ));
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return Response
     * @Route("/profile/{user_id}", name="profile_third")
     */
    public function profileThirdAction($user_id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('AcmeAccountBundle:User')->find($user_id);
        $products = $em->getRepository('AppBundle:Product')
            ->findBy(
                ['user' => $user, 'isActive'=>true],
                ['id' => 'DESC'],
                3);

        return $this->render('user/profile_third.html.twig', array(
            'user' => $user,
            'products' => $products,
            'is_followed' => $this->getUser()->isFollowing($user)
        ));
    }
}