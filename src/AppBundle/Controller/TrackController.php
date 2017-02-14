<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:12
 */

namespace AppBundle\Controller;

use AppBundle\Repository\InMemory\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TrackController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Track:index.html.twig', ['tracks' => $this->get('app.repository.in_memory.track')->findAll()]);
    }

    public function showAction(Request $request, $id)
    {
        try {
            $track = $this->get('app.repository.in_memory.artist')->find($id);
        } catch (NotFoundException $e) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Track:show.html.twig', ['track' => $track]);
    }

    public function showJsonAction($id)
    {
        try {
            $track = $this->get('app.repository.in_memory.artist')->find($id);
        } catch (NotFoundException $e) {
            throw $this->createNotFoundException();
        }

        return new JsonResponse($track);
    }

    public function sessionAction($id, Request $request)
    {
        try {
            $track = $this->get('app.repository.in_memory.artist')->find($id);
        } catch (NotFoundException $e) {
            throw $this->createNotFoundException();
        }

        $request->getSession()->set('track', $track);

        return $this->redirectToRoute('app_track_session_show');
    }

    public function sessionShowAction(Request $request)
    {
        return $this->render('AppBundle:Track:show.html.twig', ['track' => $request->getSession()->get('track')]);
    }
}
