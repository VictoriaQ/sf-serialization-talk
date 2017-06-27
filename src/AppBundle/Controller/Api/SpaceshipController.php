<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Spaceship;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SpaceshipController extends Controller
{
    /**
     * @Route("/api/spaceships")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

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
        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('id', 'budget', 'mission'));
        //$normalizer->setCircularReferenceHandler(function ($object) {
        //        return $object->getName();
        //});
        //$normalizer->setCircularReferenceLimit(1);
        $normalizers = array($normalizer);

        $serializer = new Serializer($normalizers, $encoders);

        $spaceship = $this->getDoctrine()
                ->getRepository('AppBundle:Spaceship')
                ->findOneByName($name);

        $groups = ['groups' => ['list']];
        $response = new Response($serializer->serialize($spaceship, 'json', $groups), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }
}
