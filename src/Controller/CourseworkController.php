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
        $courseworkDescription = $this->courseworkRepository->getCourseworkDescription($coursework->getId());
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

        if (in_array('plagiat', $result)) {
            $plagiat = $this->courseworkRepository->plagiatParameter($result, $coursework->getId());
        } else {
            $plagiat = null;
        }


        return $this->render('coursework.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
            'coursework' => $parameterName,
            'description' => $courseworkDescription[0],
            'result' => $result,
            'plagiat' => $plagiat,
        ]);
    }

    /**
     * @Route("/antiplagiat", name="app_antiplagiat", methods="POST")
     */
    public function antiplagiat(Request $request): Response
    {
        $dataCourseworks = $this->courseworkRepository->getDataCoursework($request->get('coursework'));
        $plagiatRender = $this->render('success/plagiat.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);

        $dependenceRender = $this->render('success/dependence.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);

        foreach ($dataCourseworks as $data){
            $data = $this->unsetName($data);
            $count = 0;
            $plagiat = 0;
            foreach ($data as $value){
                $count++;
                if ($this->stringToFloat($value) == $this->stringToFloat($request->get($count))){
                    $plagiat++;
                }
            }
            if ($antiplagiat = $plagiat/$count >= 0.8) {
                return $plagiatRender;
            }

        }
        switch ($request->get('coursework')){
            case 1:
                $var1 = round(0.086 * $this->stringToFloat($request->get('3')), 2);
                $var2 = round($this->stringToFloat($request->get('8')), 2);
                if ($var1 !== $var2){
                    return $dependenceRender;
                }

                $var1 = round($this->stringToFloat($request->get('15')), 2);
                $var2 = round(0.14, 2);
                if ($var1 > $var2){
                    return $dependenceRender;
                }

                $var1 = round($this->stringToFloat($request->get('25')), 2);
                $var2 = round($this->stringToFloat($request->get('22')) - $this->stringToFloat($request->get('23')) - $this->stringToFloat($request->get('24')), 2);
                if ($var1 !== $var2){
                    return $dependenceRender;
                }


                $var1 = round($this->stringToFloat($request->get('26')), 2);
                $var2 = round(0.28, 2);
                if ($var1 > $var2){
                    return $dependenceRender;
                }

                $x = round($this->stringToFloat($request->get('6')), 10);
                $e = round($this->stringToFloat($request->get('19')), 10);
                $var1 = round((float)((0.01 * $x * $x) - (0.019 * $x)  + (0.055)), 10);
                $var2 = round((float)((0.0075 * $x * $x) - (0.0065 * $x)  + (0.054)), 10);
                if (!($var1 < $e && $e < $var2)){
                    return $dependenceRender;
                }

                $this->courseworkRepository->addCourseworkResult1($request, $this->getUser());
                break;

            case 2:
                $var1 = round($this->stringToFloat($request->get('24')) / $this->stringToFloat($request->get('23')), 10);
                $var2 = round($this->stringToFloat($request->get('25')) / $this->stringToFloat($request->get('26')), 10);
                if ($var1 !== $var2){
                    //return $dependenceRender;
                }

                $var1 = round($this->stringToFloat($request->get('11')), 10);

                $var2 = round($this->stringToFloat($request->get('13')) * deg2rad(sin($this->stringToFloat($request->get('18')))), 10);

                var_dump($var1);
                var_dump((sin(14)));
                if ($var1 !== $var2){
                    echo 'ok';
                    //return $dependenceRender;
                }

                $var1 = round($this->stringToFloat($request->get('21')) * 0.85 * 1000, 10);
                $var2 = round(750 * $this->stringToFloat($request->get('20')) * 9.81 * $this->stringToFloat($request->get('5')) /
                    $this->stringToFloat($request->get('21')) * 0.85 * 1000, 10);

                if (($div = $var1 / $var2) < 1) {
                    $div = 1 - $div;
                    if ($div >= 0.08) {
                        //return $dependenceRender;
                    }
                }
                if (($div = $var2 / $var1) < 1) {
                    $div = 1 - $div;
                    if ($div >= 0.08) {
                        //return $dependenceRender;
                    }
                }

                $var1 = round(1.25 * $this->stringToFloat($request->get('2')) * (0.0344 * log($this->stringToFloat($request->get('27'))) + 0.3358)/(2 * 120 - 1.25 * $this->stringToFloat($request->get('2'))), 10);
                $var2 = round(750 * $this->stringToFloat($request->get('30')), 10);

                if (($div = $var1 / $var2) < 1) {
                    $div = 1 - $div;
                    if ($div >= 0.03) {
                        //return $dependenceRender;
                    }
                }
                if (($div = $var2 / $var1) < 1) {
                    $div = 1 - $div;
                    if ($div >= 0.03) {
                        //return $dependenceRender;
                    }
                }

                $var = (int)($request->get('7'));
                if ($var !== 1500 && $var !== 3000){
                    //return $dependenceRender;
                }


                $this->courseworkRepository->addCourseworkResult2($request, $this->getUser());
                break;
            case 3:
                echo 3;
                $this->courseworkRepository->addCourseworkResult3($request, $this->getUser());
                break;
            case 4:
                echo 4;
                $this->courseworkRepository->addCourseworkResult4($request, $this->getUser());
                break;
            case 5:
                $this->courseworkRepository->addCourseworkResult5($request, $this->getUser());
                break;
        }


        return $this->render('success/success.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);
    }

    private function stringToFloat(?string $str): ?float
    {
        return (float)str_replace(',', '.', $str);
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
