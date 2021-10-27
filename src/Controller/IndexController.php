<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {

        $usersRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $usersRepository->findAll();


        if ( $users )
        {
            return $this->render('index/index.html.twig', [
                    "users" => $users]
            );
        }
        else
            return $this->render('index/index.html.twig', [
                    'users' => null,
                ]
            );
    }
}
