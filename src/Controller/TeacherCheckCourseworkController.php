<?php

namespace App\Controller;

use App\Entity\Coursework;
use App\Entity\User;
use App\Repository\CourseworkRepository;
use App\Service\HeaderService;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TeacherCheckCourseworkController extends AbstractController
{
    private $encoder;

    private $em;

    /** @var CourseworkRepository */
    private $courseworkRepository;

    public function __construct(
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $entityManager,
        CourseworkRepository $courseworkRepository
    )
    {
        $this->encoder = $encoder;
        $this->em = $entityManager;
        $this->courseworkRepository = $courseworkRepository;
    }


    /**
     * @Route("/check/coursework/{coursework}", name="check_coursework")
     */
    public function addUser(Coursework $coursework): Response
    {
        if ($this->getUser()->getRoles()[0] === User::ROLE_USER) {
            throw new \Exception('Access denied');
        }

        $courseworkDescription = $this->courseworkRepository->getCourseworkDescription($coursework);

        return $this->render('teacher/check-coursework.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'coursework' =>  $courseworkDescription[0]
        ]);
    }

    /**
     * @Route("/api/v1/add/user", name="api_add_user")
     */
    public function addCourseworkResult1(Request $request): Response
    {


        return $this->render('success/success-add-user.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);
    }
}
