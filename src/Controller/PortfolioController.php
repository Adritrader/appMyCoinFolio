<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolios", name="portfolios")
     */
    public function index(): Response
    {
        return $this->render('portfolio/create_category.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }
}
