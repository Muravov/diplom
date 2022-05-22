<?php

namespace App\Controller;

use App\Entity\Coursework;
use App\Repository\CourseworkRepository;
use App\Service\HeaderService;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CourseworkController extends AbstractController
{
    /** @var CourseworkRepository */
    private $courseworkRepository;

    public function __construct(CourseworkRepository $courseworkRepository)
    {
        $this->courseworkRepository = $courseworkRepository;
    }

    /**
     * @Route("/coursework/{coursework}", name="app_coursework", methods="GET")
     */
    public function coursework(Coursework $coursework): Response
    {
        $courseworkDescription = $this->courseworkRepository->getCourseworkDescription($coursework);
        $courseworkData = $this->courseworkRepository->getDataCoursework($coursework->getId());
        $parameterName = $courseworkData[0];

        unset(
            $parameterName['COL 1'],
            $parameterName['COL 2'],
            $parameterName['COL 3'],
            $parameterName['COL 4'],
            $parameterName['COL 5']
        );

        $result = $this->courseworkRepository->findCourseworkUser($coursework, $this->getUser());

        return $this->render('coursework.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'coursework' => $parameterName,
            'description' => $courseworkDescription[0],
            'result' => $result,
        ]);
    }

    /**
     * @Route("/antiplagiat", name="app_antiplagiat", methods="POST")
     */
    public function antiplagiat(Request $request): Response
    {
        $dataCourseworks = $this->courseworkRepository->getDataCoursework($request->get('coursework'));

        foreach ($dataCourseworks as $data){
            $data = $this->unsetName($data);
            $count = 0;
            $plagiat = 0;
            foreach ($data as $value){
                $count++;
                if ($value == $request->get($count)){
                    $plagiat++;
                }

            }
            if ($antiplagiat = $plagiat/$count >= 0.8) {
                return $this->render('success/plagiat.html.twig', [
                    'header' =>  HeaderService::getHeaderData($this->getUser()),
                ]);
            }

        }
        switch ($request->get('coursework')){
            case 1:
                $this->courseworkRepository->addCourseworkResult1($request, $this->getUser());
                break;
            case 2:
                $this->courseworkRepository->addCourseworkResult2($request, $this->getUser());
                break;
            case 3:
                $this->courseworkRepository->addCourseworkResult3($request, $this->getUser());
                break;
            case 4:
                $this->courseworkRepository->addCourseworkResult4($request, $this->getUser());
                break;
        }


        return $this->render('success/success.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);
    }

    public function unsetName(array $array): array
    {
        unset(
            $array['COL 1'],
            $array['COL 2'],
            $array['COL 3'],
            $array['COL 4'],
            $array['COL 5']
        );

        return $array;
    }
}
