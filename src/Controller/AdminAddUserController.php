<?php

namespace App\Controller;

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

class AdminAddUserController extends AbstractController
{
    private $encoder;

    private $em;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        $this->encoder = $encoder;
        $this->em = $entityManager;
    }


    /**
     * @Route("/add/user", name="admin_add_user")
     */
    public function addUser(): Response
    {
        if ($this->getUser()->getRoles()[0] !== User::ROLE_ADMIN) {
            throw new \Exception('Access denied');
        }

        return $this->render('admin/add-user.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);
    }

    /**
     * @Route("/api/v1/add/user", name="api_add_user")
     */
    public function apiAddUser(Request $request): Response
    {
        $usersData = [
            'email' => $request->get('email'),
            'gruppa' => $request->get('gruppa'),
            'fio' => $request->get('fio'),
            'role' => ['ROLE_USER'],
            'password' => $request->get('password')
        ];

        $newUser = new User();

        $newUser
            ->setEmail($usersData['email'])
            ->setGruppa($usersData['gruppa'])
            ->setFio($usersData['fio'])
            ->setPassword($this->encoder->encodePassword($newUser, $usersData['password']))
            ->setRoles($usersData['role']);

        $this->em->persist($newUser);
        $this->em->flush();

        return $this->render('success/success-add-user.html.twig', [
            'header' =>  HeaderService::getHeaderData($this->getUser()),
        ]);
    }
}
