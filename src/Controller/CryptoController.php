<?php

namespace App\Controller;

use App\Entity\Contain;
use App\Entity\Crypto;
use App\Entity\Portfolio;
use App\Form\CryptoType;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @Route("/portfolio/{id}/show/crypto", name="create_crypto", requirements={"id"="\d+"})
     */
    public function create(Request $request, int $id): Response
    {
        $crypto = new Crypto();
        $contain = new Contain();

        $portfolioRepository = $this->getDoctrine()->getRepository(Portfolio::class);
        $portfolio = $portfolioRepository->find($id);

        $form = $this->createForm(CryptoType::class, $crypto);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $crypto = $form->getData();
            $contain->setCrypto($crypto);
            $contain->setPortfolio($portfolio);

            // Save category on BD

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($crypto);
            $entityManager->persist($contain);
            $entityManager->flush();

            //Logger

            $logger = new Logger('Crypto');
            $logger2 = new Logger('Contain');
            $logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
            $logger->info('Crypto ' . $crypto->getName() . ' successfully registered on ' . date("Y-m-d H:i:s", time()));
            $logger2->info('Contain ' . $crypto->getId() . ' successfully registered on ' . date("Y-m-d H:i:s", time()));

            // Flash message

            $this->addFlash('success', "Category has been created succesfully");


            return $this->redirectToRoute('index');
        }


        return $this->render('crypto/index.html.twig', array(
            'form' => $form->createView()));
    }

}
