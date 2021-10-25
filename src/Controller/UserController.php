<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserType;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {


        $usersRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $usersRepository->findAll();


        if ( $users )
        {
            return $this->render('user/index.html.twig', [
                    "users" => $users]
            );
        }
        else
            return $this->render('user/index.html.twig', [
                    'users' => null,
                ]
            );
    }

    /**
     * @Route("users/create", name="create_user")
     */
    public function createBack(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuario = $form->getData();
            if ($posterFile = $form['avatar']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $posterFile->guessExtension();

                try {
                    $projectDir = $this->getParameter('kernel.project_dir');
                    $posterFile->move($projectDir . '/public/img/', $filename);

                    if(empty($filename)){

                        $usuario->setAvatar("nofoto.jpg");

                    } else {

                        $usuario->setAvatar($filename);

                    }
                } catch (FileException $e) {
                    $this->addFlash('danger', $e->getMessage());
                    return $this->redirectToRoute('index');
                }
            }

            //Encriptamos la contraseña

            $hashedPassword = $encoder->encodePassword($usuario, $usuario->getPassword());
            $usuario->setPassword($hashedPassword);


            // Asignamos la fecha de actualización, por defecto es la fecha de creación del usuario

            $usuario->setCreatedAt(new \DateTime());


            $updated = date("Y-m-d H:i:s", time());
            $usuario->setUpdatedAt($updated);

            // Guardamos el usuario en la BD

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();

            //Logger

            $logger = new Logger('usuario');
            $logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
            $logger->info('Se ha registrado un usuario nuevo');

            // Flash message

            $this->addFlash('success', "Se ha registrado correctamente");


            return $this->redirectToRoute('users');
        }
        return $this->render('user/create_user.html.twig', array(
            'form' => $form->createView()));
    }


    /**
     * @Route("/users/{id}/edit", name="edit_user")
     */
    public function editUser(int $id, Request $request)
    {

        $usuarioRepository = $this->getDoctrine()->getRepository(User::class);
        $usuarios = $usuarioRepository->find($id);
        $form = $this->createForm(EditUserType::class, $usuarios);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuarios = $form->getData();
            if ($posterFile = $form['avatar']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $posterFile->guessExtension();

                try {
                    $projectDir = $this->getParameter('kernel.project_dir');
                    $posterFile->move($projectDir . '/public/img/', $filename);
                    $usuarios->setAvatar($filename);
                } catch (FileException $e) {
                    $this->addFlash(
                        'danger',
                        $e->getMessage()
                    );
                    return $this->redirectToRoute('index');
                }
            }

            $usuarios->setModifiedAt(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuarios);
            $entityManager->flush();
            $this->addFlash('success', "El usuario " . $usuarios->getUsername() . " ha sido editado correctamente!");

            //LOGGER

            $logger = new Logger('usuario');
            $logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
            $logger->info('Se ha editado el usuario' . $usuarios->getUsername() . 'correctamente');

            return $this->redirectToRoute('index');
        }
        return $this->render('user/edit_user.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     *@Route("/users/{id}/delete", name="delete_user", requirements={"id"="\d+"})
     */
    public function delete(int $id)
    {

        /*
        $this->denyAccessUnlessGranted('ROLE_ADMIN',
            null, 'Acceso restringido a administradores');*/

        $usuarioRepository = $this->getDoctrine()->getRepository(User::class);
        $usuario = $usuarioRepository->find($id);

        return $this->render('user/delete_user.html.twig', ["user" => $usuario]);

    }

    /**
     *@Route("/users/{id}/destroy", name="destroy_user", requirements={"id"="\d+"})
     */
    public function destroy(int $id)
    {

        /*
        $this->denyAccessUnlessGranted('ROLE_ADMIN',
            null, 'Acceso restringido a administradores');*/


        $entityManager =$this->getDoctrine()->getManager();
        $usuarioRepository = $this->getDoctrine()->getRepository(User::class);
        $usuario = $usuarioRepository->find($id);

        if ($usuario) {
            $entityManager->remove($usuario);
            $entityManager->flush();
            $this->addFlash('success', "El usuario " . $usuario->getUsername() . " ha sido eliminado correctamente!");

            //LOGGER

            $logger = new Logger('usuario');
            $logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
            $logger->info("El usuario " . $usuario->getUsername() . " ha sido eliminado");

            return $this->redirectToRoute('index');
        }
        return $this->render('user/index.html.twig');
    }

}