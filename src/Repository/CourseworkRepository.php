<?php

namespace App\Repository;

use App\Entity\Coursework;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Result;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use phpDocumentor\Reflection\Types\Mixed_;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Coursework|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coursework|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coursework[]    findAll()
 * @method Coursework[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseworkRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    /** @var Connection */
    protected $connection;

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(ManagerRegistry $registry, Connection $connection, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Coursework::class);

        $this->connection = $connection;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Coursework $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Coursework $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getCourseworks(): array
    {
        return $this
            ->createQueryBuilder('coursework')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addCoursework(Coursework $coursework): void
    {
        $this->add($coursework);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getDataCoursework(string $coursework): array
    {
        $this->entityManager->beginTransaction();

        try{
            $query = $this->connection->executeQuery(sprintf('SELECT * FROM `сoursework_%d`', $coursework));
        } catch (\Exception $exception) {
            throw $exception;
        }

        return $query->fetchAllAssociative();
    }

    public function addCourseworkResult1(Request $request, UserInterface $user): void
    {
        $linki = mysqli_connect('localhost', 'root', 'root', 'diplom');

        $query = "SELECT max(id) FROM `сoursework_result_1`";
        $id = mysqli_query($linki, $query);
        $id = mysqli_fetch_array($id);
        $id_new = $id['max(id)'] + 1;

        $sql = sprintf("
            INSERT INTO `сoursework_result_1`(
                `id`, `id_user`,`id_prepod`,`status`, `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`)  
            VALUES (
                    '{$id_new}','{$user->getId()}', NULL, 0, '{$user->getFio()}', '{$user->getGruppa()}', NULL, NULL, NULL,
                    '{$request->get("1")}', '{$request->get("2")}', '{$request->get("3")}', '{$request->get("4")}',
                    '{$request->get("5")}', '{$request->get("6")}', '{$request->get("7")}', '{$request->get("8")}',
                    '{$request->get("9")}', '{$request->get("10")}', '{$request->get("11")}', '{$request->get("12")}',
                    '{$request->get("13")}', '{$request->get("14")}', '{$request->get("15")}', '{$request->get("16")}',
                    '{$request->get("17")}', '{$request->get("18")}', '{$request->get("19")}', '{$request->get("20")}',
                    '{$request->get("21")}', '{$request->get("22")}', '{$request->get("23")}', '{$request->get("24")}', 
                    '{$request->get("25")}', '{$request->get("26")}'
                    )"
            );
        $query = mysqli_query($linki, $sql);
        var_dump($query); die;
    }

    public function getCourseworkDescription(Coursework $coursework): array
    {
        return $this
            ->createQueryBuilder('coursework')
            ->andWhere('coursework.id = :id')
            ->setParameter('id', $coursework->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCoursework(string $coursework, string $fio, string $gruppa): ?array
    {
        $linki = mysqli_connect('localhost', 'root', 'root', 'diplom');
        try{
            $sql = sprintf("SELECT * FROM `сoursework_result_{$coursework}` WHERE `COL 1` = '{$fio}' AND `COL 2` = '{$gruppa}' AND `status` = 0");
            $query = mysqli_query($linki, $sql);
            $courseworkResult = mysqli_fetch_array($query);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
        return $courseworkResult;
    }
}
