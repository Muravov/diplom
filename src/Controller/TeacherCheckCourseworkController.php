<?php

namespace App\Controller;

use App\Entity\Coursework;
use App\Entity\User;
use App\Repository\CourseworkRepository;
use App\Service\HeaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $courseworkDescription = $this->courseworkRepository->getCourseworkDescription($coursework->getId());

        $grupps = $this->courseworkRepository->getGruppa();

        return $this->render('teacher/gruppa-coursework.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'coursework' =>  $courseworkDescription[0],
            'grupps' => $grupps
        ]);
    }

    /**
     * @Route("/api/v1/find/stundents", name="api_find_students")
     */
    public function findStundents(Request $request): Response
    {
        $gruppa = $request->get('gruppa');
        $coursework = $request->get('coursework');
        $students = $this->courseworkRepository->getStudnets($gruppa);

        $courseworkDescription = $this->courseworkRepository->getCourseworkDescription($coursework);
        $courseworkResult = $this->courseworkRepository->getCourseworkResult($coursework, $gruppa);

        return $this->render('teacher/students-coursework.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'coursework' =>  $courseworkDescription[0],
            'gruppa' => $gruppa,
            'courseworkResult' => $courseworkResult
        ]);
    }

    /**
     * @Route("/get/coursework", name="api_get_coursework")
     */
    public function getCoursework(Request $request): Response
    {
        $fio = $request->get('fio');
        $gruppa = $request->get('gruppa');
        $coursework = $request->get('coursework');

        if (!$courseworkResultData = $this->courseworkRepository->findCourseworkResult($coursework, $fio, $gruppa)) {
            return $this->render('teacher/success/not-found.html.twig', [
                'header' =>  HeaderService::getHeaderData($this->getUser())
            ]);
        }

        $student['fio'] = $courseworkResultData[4];
        $student['gruppa'] = $courseworkResultData[5];

        switch ($coursework){
            case 1:
                $count = 34;
                break;
            case 2:
                $count = 38;
                break;
            case 3:
                $count = 44;
                break;
            case 4:
                $count = 46;
                break;
            case 5:
                $count = 35;
                break;
        }
        $courseworkResult = array();
        for ($i = 9; $i <= $count; $i++) {
            array_push($courseworkResult, $courseworkResultData[$i]);
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
            'courseworkId' => $coursework,
            'courseworkResultId' => $courseworkResultData[0],
            'student' => $student,
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

        $courseworkResultId = $request->get('courseworkResultId');
        $courseworkId = $request->get('courseworkId');
        $assessment = $request->get('assessment');

        if ($request->get('success')) {
            switch ($courseworkId){
                case 1:
                    $this->courseworkRepository->courseworkResultAccept1($courseworkId, $courseworkResultId, $this->getUser(), $assessment);
                    break;
                case 2:
                    $this->courseworkRepository->courseworkResultAccept2($courseworkId, $courseworkResultId, $this->getUser(), $assessment);
                    break;
                case 3:
                    $this->courseworkRepository->courseworkResultAccept3($courseworkId, $courseworkResultId, $this->getUser(), $assessment);
                    break;
                case 4:
                    $this->courseworkRepository->courseworkResultAccept4($courseworkId, $courseworkResultId, $this->getUser(), $assessment);
                    break;
                case 5:
                    $this->courseworkRepository->courseworkResultAccept5($courseworkId, $courseworkResultId, $this->getUser(), $assessment);
                    break;
            }

            return $this->render('teacher/success/success.html.twig', [
                'header' =>  HeaderService::getHeaderData($this->getUser())
            ]);
        } else {
            switch ($courseworkId){
                case 1:
                    $this->courseworkRepository->courseworkResultReject1($request, $courseworkResultId, $this->getUser());
                    break;
                case 2:
                    $this->courseworkRepository->courseworkResultReject2($request, $courseworkResultId, $this->getUser());
                    break;
                case 3:
                    $this->courseworkRepository->courseworkResultReject3($request, $courseworkResultId, $this->getUser());
                    break;
                case 4:
                    $this->courseworkRepository->courseworkResultReject4($request, $courseworkResultId, $this->getUser());
                    break;
                case 5:
                    $this->courseworkRepository->courseworkResultReject5($request, $courseworkResultId, $this->getUser());
                    break;
            }

            return $this->render('teacher/success/fuckup.html.twig', [
                'header' =>  HeaderService::getHeaderData($this->getUser())
            ]);
        }
    }

    /**
     * @Route("/get/parameters/{coursework}", name="get_parameter", methods="GET")
     */
    public function getParameters(Coursework $coursework, Request $request): Response
    {
        return new JsonResponse(
            $this->courseworkRepository->getParameters($coursework, $request->get('parameter1'), $request->get('parameter2'))
        );
    }

    /**
     * @Route("/get/parameters/name/{coursework}", name="get_parameters_name", methods="GET")
     */
    public function getParametersName(Coursework $coursework): Response
    {
        return new JsonResponse(
            $this->courseworkRepository->getParametersName($coursework)
        );
    }
}
