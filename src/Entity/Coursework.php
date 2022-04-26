<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\Entity\AbstractEntityInheritancePersister;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=App\Repository\CourseworkRepository::class)
 */
class Coursework
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2400)
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $course;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $semester;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCourse(): string
    {
        return $this->course;
    }

    public function setCourse(string $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getSemester(): string
    {
        return $this->semester;
    }

    public function setSemester(string $semester): self
    {
        $this->semester = $semester;

        return $this;
    }


}
