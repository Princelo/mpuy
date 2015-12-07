<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @return RedirectResponse
     * @Route("/index", name="_admin_index")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('admin_user_list', ['page'=>1]));
    }

    /**
     * @return Response
     * @Route("/user_list/{page}", name="admin_user_list")
     */
    public function userListAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $where = "";
        if ($request->getMethod() == 'GET') {
            $where = $this->_getUserSearchStr($request->query->get('search'));
        }
        $queryArticlelist = $em->getRepository('AcmeAccountBundle:User')
            ->getQueryUserList($where);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryArticlelist,
            $request->query->get('page', $page)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('AcmeAdminBundle:default:user_list.html.twig',
            array('pagination' => $pagination,
                'page' => $page,
            ));
    }

    /**
     * @return Response
     * @Route("/product_list/{page}", name="admin_product_list")
     */
    public function productListAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $where = "";
        if ($request->getMethod() == 'GET') {
            $where = $this->_getProductSearchStr($request->query->get('search'));
        }
        $querylist = $em->getRepository('AppBundle:Product')
            ->getQueryProductList($where);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $querylist,
            $request->query->get('page', $page)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('AcmeAdminBundle:default:product_list.html.twig',
            array('pagination' => $pagination,
                'page' => $page,
            ));
    }

    /**
     * @return Response
     * @Route("/order_list/{page}", name="admin_order_list")
     */
    public function orderListAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $where = "";
        $queryArticlelist = $em->getRepository('AppBundle:AuctionOrder')
            ->getQueryOrderList($where);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryArticlelist,
            $request->query->get('page', $page)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('AcmeAdminBundle:default:order_list.html.twig',
            array('pagination' => $pagination,
                'page' => $page,
            ));
    }

    /**
     * @return Response
     * @Route("/payment_list/{page}", name="admin_payment_list")
     */
    public function paymentListAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $where = "";
        if ($request->getMethod() == 'GET') {
            $where = $this->_getUserSearchStr($request->query->get('search'));
        }
        $queryArticlelist = $em->getRepository('AppBundle:User')
            ->getQueryUserList($where);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryArticlelist,
            $request->query->get('page', $page)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('AcmeAdminBundle:default:user_list.html.twig',
            array('pagination' => $pagination,
                'page' => $page,
            ));
    }

    /**
     * @return Response
     * @Route("/order_event_list/{page}", name="admin_order_event_list")
     */
    public function orderEventListAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $where = "";
        if ($request->getMethod() == 'GET') {
            $where = $this->_getUserSearchStr($request->query->get('search'));
        }
        $queryArticlelist = $em->getRepository('AppBundle:User')
            ->getQueryUserList($where);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryArticlelist,
            $request->query->get('page', $page)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('AcmeAdminBundle:default:user_list.html.twig',
            array('pagination' => $pagination,
                'page' => $page,
            ));
    }

    public function _getUserSearchStr($search = null)
    {
        $where = "";
        if($search != null)
            $where .= " AND u.nickname LIKE '%{$search}%'";
        //if($intCategory != null)
        //    $strWhere .= " AND a.intCategory = {$intCategory}";
        return $where;
    }

    public function _getProductSearchStr($search = null)
    {
        $where = "";
        if($search != null)
            $where .= " AND ( p.name LIKE '%{$search}%' OR p.intro LIKE '%{$search}%' )";
        //if($intCategory != null)
        //    $strWhere .= " AND a.intCategory = {$intCategory}";
        return $where;
    }
}
