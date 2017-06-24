<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Spaceship;

class SpaceshipController extends Controller
{
    /**
     * @Route("/api/spaceships")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $serializer = $this->container->get('jms_serializer');
        $spaceship = $serializer->deserialize($request->getContent(), Spaceship::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($spaceship);
        $em->flush();

        return new Response("Spaceship created!");
    }

    /**
     * @Route("/api/spaceships/{name}")
     * @Method("GET")
     */
    public function showAction($name)
    {
        $spaceship = $this->getDoctrine()
                ->getRepository('AppBundle:Spaceship')
                ->findOneByName($name);

        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($spaceship, 'json'), 200);
    }
}
