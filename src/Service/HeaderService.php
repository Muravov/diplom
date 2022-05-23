<?php

namespace App\Service;

use App\Entity\Roles;
use App\Entity\User;
use \Symfony\Component\Security\Core\User\UserInterface;

class HeaderService
{
    public static function getHeaderData(UserInterface $user): array
    {
        $roles = $user->getRoles();
        if ($roles[0] === User::ROLE_ADMIN) {
            $result = [
                'role' => Roles::NAMES[User::ROLE_ADMIN],
                'fio' => $user->getFio(),
                'gruppa' => $user->getGruppa()
            ];
        } elseif ($roles[0] === User::ROLE_TEACHER) {
            $result = [
                'role' => Roles::NAMES[User::ROLE_TEACHER],
                'fio' => $user->getFio(),
                'gruppa' => $user->getGruppa()
                ];
        } else {
            $result = [
                'role' => Roles::NAMES[User::ROLE_USER],
                'fio' => $user->getFio(),
                'gruppa' => $user->getGruppa()
                ];
        }
        return $result;
    }
}