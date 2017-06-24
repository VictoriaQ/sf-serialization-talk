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
        $data = json_decode($request->getContent(), true);
        $spaceship = new Spaceship();
        $spaceship->setName($data['name']);        
        $spaceship->setColor($data['color']);
        $spaceship->setMaxSpeed($data['maxSpeed']);        

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

        $data = array(
            'name' => $spaceship->getName(),
            'color' => $spaceship->getColor(),
            'maxSpeed' => $spaceship->getMaxSpeed(),
        );

        return new Response(json_encode($data), 200);
    }
}
