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
     * @return Response
     * @Route("/index", name="_admin_index")
     */
    public function indexAction()
    {
        return new Response();
    }
}
