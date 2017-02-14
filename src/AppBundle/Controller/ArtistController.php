<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:11
 */

namespace AppBundle\Controller;

use AppBundle\Repository\InMemory\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArtistController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Artist:index.html.twig', ['artists' => $this->get('app.repository.in_memory.artist')->findAll()]);
    }

    public function showAction($id)
    {
        try {
            $track = $this->get('app.repository.in_memory.artist')->find($id);
        } catch (NotFoundException $e) {
            throw $this->createNotFoundException();
        }


        return $this->render('AppBundle:Artist:show.html.twig', ['artist' => $track]);
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
}
