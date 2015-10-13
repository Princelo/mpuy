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
}