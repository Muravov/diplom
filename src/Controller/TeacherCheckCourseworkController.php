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
    public function checkCoursework(Coursework $coursework): Response
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
     * @Route("/api/v1/get/coursework", name="api_get_coursework")
     */
    public function getCoursework(Request $request): Response
    {
        $fio = $request->get('fio');
        $gruppa = $request->get('gruppa');
        $coursework = $request->get('coursework');

        $courseworkData = $this->courseworkRepository->findCoursework($coursework, $fio, $gruppa);
        $courseworkResult = array();
        for ($i = 9; $i < 35; $i++) {
            array_push($courseworkResult, $courseworkData[$i]);
        }

        $courseworkData = $this->courseworkRepository->getDataCoursework($coursework);

        $parameterName = $courseworkData[0];

        unset(
            $parameterName['COL 1'],
            $parameterName['COL 2'],
            $parameterName['COL 3'],
            $parameterName['COL 4'],
            $parameterName['COL 5']
        );

        return $this->render('teacher/show-coursework.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'coursework' =>  $courseworkResult,
            'parameter' => $parameterName,
        ]);
    }

    /**
     * @Route("/accept/coursework", name="accept_coursework")
     */
    public function acceptCoursework(Request $request): Response
    {
        if ($this->getUser()->getRoles()[0] === User::ROLE_USER) {
            throw new \Exception('Access denied');
        }

        if ($request->get('success')) {
            return $this->render('teacher/success/success.html.twig', [
                'header' =>  HeaderService::getHeaderData($this->getUser())
            ]);
        } else {
            return $this->render('teacher/success/fuckup.html.twig', [
                'header' =>  HeaderService::getHeaderData($this->getUser())
            ]);
        }
    }
}
