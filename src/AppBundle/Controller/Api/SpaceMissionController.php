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
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

class SpaceMissionController extends Controller
{
    /**
     * @Route("/api/missions")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);    

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
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $normalizer->setIgnoredAttributes(array('id', 'budget'));
        //$normalizer->setCircularReferenceHandler(function ($object) {
        //        return $object->getName();
        //});
        //$normalizer->setCircularReferenceLimit(1);
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);    

        $mission = $this->getDoctrine()
                ->getRepository('AppBundle:SpaceMission')
                ->findOneByName($name);

        $callback = function ($logoPath) {
            return 'thumb_'.$logoPath;
        };

        $normalizer->setCallbacks(array('logo' => $callback));

        $groups = ['groups' => ['list']];
        $response = new Response($serializer->serialize($mission, 'json', $groups), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }
}
