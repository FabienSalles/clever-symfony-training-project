<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Default:index.html.twig', ['name' => $request->query->get('name')]);
    }

    public function generate404Action()
    {
        throw $this->createNotFoundException();
    }
}
