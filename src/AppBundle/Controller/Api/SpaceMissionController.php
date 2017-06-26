<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Spaceship;
use AppBundle\Entity\SpaceMission;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use JMS\Serializer\SerializationContext;

class SpaceMissionController extends Controller
{
    /**
     * @Route("/api/missions")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $serializer = $this->container->get('jms_serializer');
        $mission = $serializer->deserialize($request->getContent(), SpaceMission::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($mission);
        $em->flush();

        return new Response("Mission created!");
    }

    /**
     * @Route("/api/missions/{name}")
     * @Method("GET")
     */
    public function showAction($name)
    {
        $serializer = $this->container->get('jms_serializer');

        $mission = $this->getDoctrine()
                ->getRepository('AppBundle:SpaceMission')
                ->findOneByName($name);

        $response = new Response($serializer->serialize($mission, 'json', SerializationContext::create()
            ->setVersion(2.1)
            ->setGroups(array('list')))
        ,200);
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }
}
