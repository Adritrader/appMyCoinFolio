<?php


namespace App\Controller;

use App\Entity\Analysis;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\AnalysisRepository;
use App\Repository\UserRepository;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/api/v1")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/users", name="api_users", methods={"GET"})
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function users(Request $request, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->findAll();

        return new JsonResponse($user, Response::HTTP_OK);
    }

    /**
     * @Route("/analysis", name="api_analysis", methods={"GET"})
     * @param Request $request
     * @param AnalysisRepository $analysisRepository
     * @return JsonResponse
     */
    public function analysis(Request $request, AnalysisRepository $analysisRepository): JsonResponse
    {
        $analysis = $analysisRepository->findAll();

        return new JsonResponse($analysis, Response::HTTP_OK);
    }

    /**
     * @Route("/{id}/user", name="api_user_show", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function showUser(Request $request,  ?User $user): JsonResponse
    {

        var_dump($user);

        if (!empty($user))
            return new JsonResponse($user, Response::HTTP_OK);

        else
            return new JsonResponse("error", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Route("/{id}/analysis", name="api_analysis_show", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request,  ?Analysis $analysis): JsonResponse
    {

        if (!empty($analysis))
            return new JsonResponse($analysis, Response::HTTP_OK);

        else
            return new JsonResponse("error", Response::HTTP_NOT_FOUND);
    }


}