<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:11
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArtistController extends Controller
{
    public static $artists = [
        [
            'id'      => 1,
            'name'    => 'Foo fighters',
            'type'    => 'band', // solo
            'picture' => 'http://rockmetalmag.fr/wp-content/uploads/2014/05/foo_fighters_52847.jpg',
            'genre'   => 'rock',
        ],
        [
            'id'      => 5,
            'name'    => 'Claude François',
            'type'    => 'band', // solo
            'picture' => 'http://rockmetalmag.fr/wp-content/uploads/2014/05/foo_fighters_52847.jpg',
            'genre'   => 'variétés',
        ],
    ];


    public function indexAction()
    {
        return $this->render('AppBundle:Artist:index.html.twig', ['artists' => $this->findAll()]);
    }

    public function showAction($id)
    {
        $track = $this->find($id);

        return $this->render('AppBundle:Artist:show.html.twig', ['artist' => $track]);
    }

    public function showJsonAction($id)
    {
        $track = $this->find($id);

        return new JsonResponse($track);
    }

    private function find($id)
    {
        $key  = array_search($id, array_column(self::$artists, 'id'));

        if (false === $key) {
            throw $this->createNotFoundException();
        }
        
        return self::$artists[$key];
    }

    private function findAll()
    {
        return self::$artists;
    }
}
