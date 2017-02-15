<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:11
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Artist;
use AppBundle\Form\Type\ArtistType;
use AppBundle\Repository\InMemory\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

    public function newAction(Request $request)
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('app_artist_index'));
        }

        return $this->render('AppBundle:Artist:new.html.twig', ['form' => $form->createView()]);
    }
}
