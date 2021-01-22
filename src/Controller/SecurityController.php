<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use App\Entity\User;
use App\Entity\Address;

class SecurityController extends AbstractController
{

    /**
     * @Route("/app/security/register", name="api_register")
     * @param  Request $request 
     * @return Json
     */
    public function register(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $content = json_decode($request->getContent(), true);

        try {
            $address = new Address();
            $address 
                ->setCity($content['address']['city'])
                ->setStreet($content['address']['street'])
                ->setCp($content['address']['cp']);

            $user = new User();
            $user
                ->setPlainPassword($content['password'])
                ->setEmail($content['email'])
                ->setUsername($content['email'])
                ->setLastname($content['lastname'])
                ->setFirstname($content['firstname'])
                ->setAddress($address)
                ->setEnabled(true)
                ->addRole("ROLE_CITIZEN");

            $entityManager->persist($address);
            $entityManager->persist($user);
            $entityManager->flush();   
            return $this->json([
                'message' => 'success'
            ], 200);         
        } catch(Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ], 404);   
        }
    }

    /**
     * @Route("/api/user", name="api_get_user")
     * @param  NormalizerInterface $normalizer
     * @return Json(User)                 
     */
    public function getCurrentUser() {
        $user = $this->getUser();
        return $this->json([
            'user' => $user
        ], 200);     
    }
}