<?php

namespace App\Service;

use App\Entity\Roles;
use App\Entity\User;
use \Symfony\Component\Security\Core\User\UserInterface;

class TeacherService
{
    public static function saveCoursework1(UserInterface $user): array
    {
        $roles = $user->getRoles();
        if ($roles[0] === User::ROLE_ADMIN) {
            $result = [
                'role' => Roles::NAMES[User::ROLE_ADMIN],
                'fio' => $user->getFio(),
            ];
        } elseif ($roles[0] === User::ROLE_TEACHER) {
            $result = [
                'role' => Roles::NAMES[User::ROLE_TEACHER],
                'fio' => $user->getFio(),
                ];
        } else {
            $result = [
                'role' => Roles::NAMES[User::ROLE_USER],
                'fio' => $user->getFio(),
                ];
        }
        return $result;
    }
}