<?php

namespace App\Controller;

use App\Repository\CourseworkRepository;
use App\Service\HeaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends AbstractController
{
    /** @var CourseworkRepository */
    private $courseworkRepository;

    public function __construct(CourseworkRepository $courseworkRepository)
    {
        $this->courseworkRepository = $courseworkRepository;
    }

    /**
     * @Route("/index", name="app_index")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $courseworks = $this->courseworkRepository->getCourseworks();


        return $this->render('index.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'courseworks' => $courseworks,
            'error' => $error,
        ]);
    }
}
