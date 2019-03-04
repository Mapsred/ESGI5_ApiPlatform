<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        if (!isset($data['username'], $data['password'])) {
            return $this->json('Missing parameters', Response::HTTP_NOT_ACCEPTABLE);
        }
        $username = $data['username'];
        $password = $data['password'];

        $user = new User();
        $user->setUsername($username)->setPlainPassword($password);

        $em->persist($user);
        $em->flush();

        return $this->json([
            'id' => $user->getId(),
            'message' => sprintf('User %s successfully created', $user->getUsername())
        ]);
    }
}
