<?php

namespace App\Entity;

final class Roles
{
    public const NAMES = [
        User::ROLE_ADMIN => 'Администратор',
        User::ROLE_TEACHER => 'Преподаватель',
        User::ROLE_USER => 'Студент',
    ];
}