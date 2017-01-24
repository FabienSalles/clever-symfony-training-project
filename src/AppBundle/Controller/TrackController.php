<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:12
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TrackController extends Controller
{
    public static $tracks = [
        [
            'id'     => 2,
            'title'  => 'Eversort',
            'artist' => 5,
        ],
        [
            'id'     => 123,
            'title'  => 'Everlong',
            'artist' => 1,
        ],
    ];

    public function indexAction()
    {
        return $this->render('AppBundle:Track:index.html.twig', ['tracks' => $this->findAll()]);
    }

    public function showAction(Request $request, $id)
    {
        $track = $this->find($id);

        return $this->render('AppBundle:Track:show.html.twig', ['track' => $track]);
    }

    public function showJsonAction($id)
    {
        $track = $this->find($id);

        return new JsonResponse($track);
    }

    public function sessionAction($id, Request $request)
    {
        $request->getSession()->set('track', $this->find($id));

        return $this->redirectToRoute('app_track_session_show');
    }

    public function sessionShowAction(Request $request)
    {
        return $this->render('AppBundle:Track:show.html.twig', ['track' => $request->getSession()->get('track')]);
    }

    private function find($id)
    {
        $key  = array_search($id, array_column(self::$tracks, 'id'));

        if (false === $key) {
            throw $this->createNotFoundException();
        }

        return self::$tracks[$key];
    }

    private function findAll()
    {
        return self::$tracks;
    }
}
