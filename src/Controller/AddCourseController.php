<?php

namespace App\Controller;

use App\Entity\Coursework;
use App\Entity\Roles;
use App\Entity\User;
use App\Repository\CourseworkRepository;
use App\Service\HeaderService;
use Symfony\Component\HttpFoundation\Request;
use http\Exception\RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AddCourseController extends AbstractController
{
    /** @var CourseworkRepository */
    private $courseworkRepository;

    public function __construct(CourseworkRepository $courseworkRepository)
    {
        $this->courseworkRepository = $courseworkRepository;
    }

    /**
     * @Route("/add/course", name="add_course", methods="GET")
     */
    public function addCourse(): Response
    {
        if ($this->getUser()->getRoles()[0] !== User::ROLE_ADMIN) {
            throw new RuntimeException('Access denied');
        }

        return $this->render('add-course.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser())
        ]);
    }

    /**
     * @Route("/api/v1/add/course", name="api_add_course", methods="POST")
     */
    public function apiAddCourse(Request $request): Response
    {
        if ($this->getUser()->getRoles()[0] !== User::ROLE_ADMIN) {
            throw new RuntimeException('Access denied');
        }

        $coursework = new Coursework();

        $coursework->setName($request->get('name'));


        return $this->render('index.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser())
        ]);
    }
}
