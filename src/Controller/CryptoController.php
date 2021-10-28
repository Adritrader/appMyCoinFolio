<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Crypto;
use App\Form\CategoryType;
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

        $form = $this->createForm(CryptoType::class, $crypto);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            // Save category on BD

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            //Logger

            $logger = new Logger('Crypto');
            $logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
            $logger->info('Crypto ' . $crypto->getName() . ' successfully registered on ' . date("Y-m-d H:i:s", time()));

            // Flash message

            $this->addFlash('success', "Category has been created succesfully");


            return $this->redirectToRoute('index');
        }


        return $this->render('crypto/index.html.twig', array(
            'form' => $form->createView()));
    }

}
