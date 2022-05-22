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

    protected $linki;

    public function __construct(ManagerRegistry $registry, Connection $connection, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Coursework::class);

        $this->connection = $connection;
        $this->entityManager = $entityManager;
        $this->linki = mysqli_connect('localhost', 'root', 'root', 'diplom');
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
        $query = "SELECT max(id) FROM `сoursework_result_1`";
        $id = mysqli_query($this->linki, $query);
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
                    '{$id_new}','{$user->getId()}', NULL, 0, '{$user->getFio()}', '{$user->getGruppa()}', '{$user->getGender()  }', NULL, NULL,
                    '{$request->get("1")}', '{$request->get("2")}', '{$request->get("3")}', '{$request->get("4")}',
                    '{$request->get("5")}', '{$request->get("6")}', '{$request->get("7")}', '{$request->get("8")}',
                    '{$request->get("9")}', '{$request->get("10")}', '{$request->get("11")}', '{$request->get("12")}',
                    '{$request->get("13")}', '{$request->get("14")}', '{$request->get("15")}', '{$request->get("16")}',
                    '{$request->get("17")}', '{$request->get("18")}', '{$request->get("19")}', '{$request->get("20")}',
                    '{$request->get("21")}', '{$request->get("22")}', '{$request->get("23")}', '{$request->get("24")}', 
                    '{$request->get("25")}', '{$request->get("26")}'
                    )"
            );
        $query = mysqli_query($this->linki, $sql);
    }

    public function addCourseworkResult2(Request $request, UserInterface $user): void
    {
        $query = "SELECT max(id) FROM `сoursework_result_2`";
        $id = mysqli_query($this->linki, $query);
        $id = mysqli_fetch_array($id);
        $id_new = $id['max(id)'] + 1;

        $sql = sprintf("
            INSERT INTO `сoursework_result_2`(
                `id`, `id_user`,`id_prepod`,`status`, `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`, `COL 32`, `COL 33`, `COL 34`, `COL 35`)  
            VALUES (
                    '{$id_new}','{$user->getId()}', NULL, 0, '{$user->getFio()}', '{$user->getGruppa()}', '{$user->getGender()}', NULL, NULL,
                    '{$request->get("1")}', '{$request->get("2")}', '{$request->get("3")}', '{$request->get("4")}',
                    '{$request->get("5")}', '{$request->get("6")}', '{$request->get("7")}', '{$request->get("8")}',
                    '{$request->get("9")}', '{$request->get("10")}', '{$request->get("11")}', '{$request->get("12")}',
                    '{$request->get("13")}', '{$request->get("14")}', '{$request->get("15")}', '{$request->get("16")}',
                    '{$request->get("17")}', '{$request->get("18")}', '{$request->get("19")}', '{$request->get("20")}',
                    '{$request->get("21")}', '{$request->get("22")}', '{$request->get("23")}', '{$request->get("24")}', 
                    '{$request->get("25")}', '{$request->get("26")}', '{$request->get("27")}', '{$request->get("28")}', 
                    '{$request->get("29")}', '{$request->get("30")}'
                    )"
        );
        $query = mysqli_query($this->linki, $sql);
    }

    public function addCourseworkResult3(Request $request, UserInterface $user): void
    {
        $query = "SELECT max(id) FROM `сoursework_result_3`";
        $id = mysqli_query($this->linki, $query);
        $id = mysqli_fetch_array($id);
        $id_new = $id['max(id)'] + 1;

        $sql = sprintf("
            INSERT INTO `сoursework_result_3`(
                `id`, `id_user`,`id_prepod`,`status`, `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`, `COL 32`, `COL 33`, `COL 34`, `COL 35`,
                `COL 36`, `COL 37`, `COL 38`, `COL 39`, `COL 40`, `COL 41`)  
            VALUES (
                    '{$id_new}','{$user->getId()}', NULL, 0, '{$user->getFio()}', '{$user->getGruppa()}', '{$user->getGender()}', NULL, NULL,
                    '{$request->get("1")}', '{$request->get("2")}', '{$request->get("3")}', '{$request->get("4")}',
                    '{$request->get("5")}', '{$request->get("6")}', '{$request->get("7")}', '{$request->get("8")}',
                    '{$request->get("9")}', '{$request->get("10")}', '{$request->get("11")}', '{$request->get("12")}',
                    '{$request->get("13")}', '{$request->get("14")}', '{$request->get("15")}', '{$request->get("16")}',
                    '{$request->get("17")}', '{$request->get("18")}', '{$request->get("19")}', '{$request->get("20")}',
                    '{$request->get("21")}', '{$request->get("22")}', '{$request->get("23")}', '{$request->get("24")}', 
                    '{$request->get("25")}', '{$request->get("26")}', '{$request->get("27")}', '{$request->get("28")}', 
                    '{$request->get("29")}', '{$request->get("30")}', '{$request->get("31")}', '{$request->get("32")}',
                    '{$request->get("33")}', '{$request->get("34")}', '{$request->get("34")}', '{$request->get("35")}'
                    )"
        );
        $query = mysqli_query($this->linki, $sql);
    }

    public function addCourseworkResult4(Request $request, UserInterface $user): void
    {
        $query = "SELECT max(id) FROM `сoursework_result_4`";
        $id = mysqli_query($this->linki, $query);
        $id = mysqli_fetch_array($id);
        $id_new = $id['max(id)'] + 1;

        $sql = sprintf("
            INSERT INTO `сoursework_result_4`(
                `id`, `id_user`,`id_prepod`,`status`, `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`, `COL 32`, `COL 33`, `COL 34`, `COL 35`,
                `COL 36`, `COL 37`, `COL 38`, `COL 39`, `COL 40`, `COL 41`, `COL 42`, `COL 43`)  
            VALUES (
                    '{$id_new}','{$user->getId()}', NULL, 0, '{$user->getFio()}', '{$user->getGruppa()}', '{$user->getGender()}', NULL, NULL,
                    '{$request->get("1")}', '{$request->get("2")}', '{$request->get("3")}', '{$request->get("4")}',
                    '{$request->get("5")}', '{$request->get("6")}', '{$request->get("7")}', '{$request->get("8")}',
                    '{$request->get("9")}', '{$request->get("10")}', '{$request->get("11")}', '{$request->get("12")}',
                    '{$request->get("13")}', '{$request->get("14")}', '{$request->get("15")}', '{$request->get("16")}',
                    '{$request->get("17")}', '{$request->get("18")}', '{$request->get("19")}', '{$request->get("20")}',
                    '{$request->get("21")}', '{$request->get("22")}', '{$request->get("23")}', '{$request->get("24")}', 
                    '{$request->get("25")}', '{$request->get("26")}', '{$request->get("27")}', '{$request->get("28")}', 
                    '{$request->get("29")}', '{$request->get("30")}', '{$request->get("31")}', '{$request->get("32")}',
                    '{$request->get("33")}', '{$request->get("34")}', '{$request->get("34")}', '{$request->get("35")}',
                    '{$request->get("36")}', '{$request->get("37")}'
                    )"
        );
        $query = mysqli_query($this->linki, $sql);
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

    public function findCourseworkResult(string $coursework, string $fio, string $gruppa): ?array
    {
        try{
            $sql = sprintf("SELECT * FROM `сoursework_result_{$coursework}` WHERE `COL 1` = '{$fio}' AND `COL 2` = '{$gruppa}' AND `status` = 0");
            $query = mysqli_query($this->linki, $sql);
            $courseworkResult = mysqli_fetch_array($query);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
        return $courseworkResult;
    }

    public function courseworkResultAccept1(string $coursework, string $courseworkResultId, UserInterface $prepod, string $assessment): void
    {
        try{
            $sql = sprintf("UPDATE `сoursework_result_1` SET `status`= 1, `id_prepod`= '{$prepod->getId()}', `COL 4`= '{$prepod->getFio()}', `COL 5`= '{$assessment}' WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);

            $sql = sprintf("SELECT * FROM `сoursework_result_1` WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);
            $courseworkResult = mysqli_fetch_array($query);


            $sql = sprintf("
            INSERT INTO `сoursework_1`(
                `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`)  
            VALUES (
                    '{$courseworkResult['COL 1']}', '{$courseworkResult['COL 2']}', '{$courseworkResult['COL 3']}', '{$courseworkResult['COL 4']}',
                    '{$courseworkResult['COL 5']}', '{$courseworkResult['COL 6']}', '{$courseworkResult['COL 7']}', '{$courseworkResult['COL 8']}', 
                    '{$courseworkResult['COL 9']}', '{$courseworkResult['COL 10']}', '{$courseworkResult['COL 11']}', '{$courseworkResult['COL 12']}',
                    '{$courseworkResult['COL 13']}', '{$courseworkResult['COL 14']}', '{$courseworkResult['COL 15']}', '{$courseworkResult['COL 16']}', 
                    '{$courseworkResult['COL 17']}', '{$courseworkResult['COL 18']}', '{$courseworkResult['COL 19']}', '{$courseworkResult['COL 20']}', 
                    '{$courseworkResult['COL 21']}', '{$courseworkResult['COL 22']}', '{$courseworkResult['COL 23']}', '{$courseworkResult['COL 24']}',
                    '{$courseworkResult['COL 25']}', '{$courseworkResult['COL 26']}', '{$courseworkResult['COL 27']}', '{$courseworkResult['COL 28']}',
                    '{$courseworkResult['COL 29']}', '{$courseworkResult['COL 30']}', '{$courseworkResult['COL 31']}'
                    )"
            );
           $query = mysqli_query($this->linki, $sql);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
    }

    public function courseworkResultAccept2(string $coursework, string $courseworkResultId, UserInterface $prepod, string $assessment): void
    {
        try{
            $sql = sprintf("UPDATE `сoursework_result_2` SET `status`= 1, `id_prepod`= '{$prepod->getId()}', `COL 4`= '{$prepod->getFio()}', `COL 5`= '{$assessment}' WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);

            $sql = sprintf("SELECT * FROM `сoursework_result_2` WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);
            $courseworkResult = mysqli_fetch_array($query);


            $sql = sprintf("
            INSERT INTO `сoursework_2`(
                `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`, `COL 32`, `COL 33`, `COL 34`, `COL 35`)  
            VALUES (
                    '{$courseworkResult['COL 1']}', '{$courseworkResult['COL 2']}', '{$courseworkResult['COL 3']}', '{$courseworkResult['COL 4']}',
                    '{$courseworkResult['COL 5']}', '{$courseworkResult['COL 6']}', '{$courseworkResult['COL 7']}', '{$courseworkResult['COL 8']}', 
                    '{$courseworkResult['COL 9']}', '{$courseworkResult['COL 10']}', '{$courseworkResult['COL 11']}', '{$courseworkResult['COL 12']}',
                    '{$courseworkResult['COL 13']}', '{$courseworkResult['COL 14']}', '{$courseworkResult['COL 15']}', '{$courseworkResult['COL 16']}', 
                    '{$courseworkResult['COL 17']}', '{$courseworkResult['COL 18']}', '{$courseworkResult['COL 19']}', '{$courseworkResult['COL 20']}', 
                    '{$courseworkResult['COL 21']}', '{$courseworkResult['COL 22']}', '{$courseworkResult['COL 23']}', '{$courseworkResult['COL 24']}',
                    '{$courseworkResult['COL 25']}', '{$courseworkResult['COL 26']}', '{$courseworkResult['COL 27']}', '{$courseworkResult['COL 28']}',
                    '{$courseworkResult['COL 29']}', '{$courseworkResult['COL 30']}', '{$courseworkResult['COL 31']}', '{$courseworkResult['COL 32']}',
                    '{$courseworkResult['COL 33']}', '{$courseworkResult['COL 34']}', '{$courseworkResult['COL 35']}'
                    )"
            );
            $query = mysqli_query($this->linki, $sql);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
    }

    public function courseworkResultAccept3(string $coursework, string $courseworkResultId, UserInterface $prepod, string $assessment): void
    {
        try{
            $sql = sprintf("UPDATE `сoursework_result_3` SET `status`= 1, `id_prepod`= '{$prepod->getId()}', `COL 4`= '{$prepod->getFio()}', `COL 5`= '{$assessment}' WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);

            $sql = sprintf("SELECT * FROM `сoursework_result_3` WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);
            $courseworkResult = mysqli_fetch_array($query);


            $sql = sprintf("
            INSERT INTO `сoursework_3`(
                `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`, `COL 32`, `COL 33`, `COL 34`, `COL 35`,
                `COL 36`, `COL 37`, `COL 38`, `COL 39`, `COL 40`, `COL 41`)  
            VALUES (
                    '{$courseworkResult['COL 1']}', '{$courseworkResult['COL 2']}', '{$courseworkResult['COL 3']}', '{$courseworkResult['COL 4']}',
                    '{$courseworkResult['COL 5']}', '{$courseworkResult['COL 6']}', '{$courseworkResult['COL 7']}', '{$courseworkResult['COL 8']}', 
                    '{$courseworkResult['COL 9']}', '{$courseworkResult['COL 10']}', '{$courseworkResult['COL 11']}', '{$courseworkResult['COL 12']}',
                    '{$courseworkResult['COL 13']}', '{$courseworkResult['COL 14']}', '{$courseworkResult['COL 15']}', '{$courseworkResult['COL 16']}', 
                    '{$courseworkResult['COL 17']}', '{$courseworkResult['COL 18']}', '{$courseworkResult['COL 19']}', '{$courseworkResult['COL 20']}', 
                    '{$courseworkResult['COL 21']}', '{$courseworkResult['COL 22']}', '{$courseworkResult['COL 23']}', '{$courseworkResult['COL 24']}',
                    '{$courseworkResult['COL 25']}', '{$courseworkResult['COL 26']}', '{$courseworkResult['COL 27']}', '{$courseworkResult['COL 28']}',
                    '{$courseworkResult['COL 29']}', '{$courseworkResult['COL 30']}', '{$courseworkResult['COL 31']}', '{$courseworkResult['COL 32']}',
                    '{$courseworkResult['COL 33']}', '{$courseworkResult['COL 34']}', '{$courseworkResult['COL 35']}', '{$courseworkResult['COL 36']}', 
                    '{$courseworkResult['COL 37']}', '{$courseworkResult['COL 38']}', '{$courseworkResult['COL 39']}', '{$courseworkResult['COL 40']}', 
                    '{$courseworkResult['COL 41']}'
                    )"
            );
            $query = mysqli_query($this->linki, $sql);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
    }

    public function courseworkResultAccept4(string $coursework, string $courseworkResultId, UserInterface $prepod, string $assessment): void
    {
        try{
            $sql = sprintf("UPDATE `сoursework_result_4` SET `status`= 1, `id_prepod`= '{$prepod->getId()}', `COL 4`= '{$prepod->getFio()}', `COL 5`= '{$assessment}' WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);

            $sql = sprintf("SELECT * FROM `сoursework_result_4` WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);
            $courseworkResult = mysqli_fetch_array($query);


            $sql = sprintf("
            INSERT INTO `сoursework_3`(
                `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`,
                `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`,
                `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`,
                `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`,
                `COL 30`, `COL 31`, `COL 32`, `COL 33`, `COL 34`, `COL 35`,
                `COL 36`, `COL 37`, `COL 38`, `COL 39`, `COL 40`, `COL 41`,
                `COL 42`, `COL 43`)  
            VALUES (
                    '{$courseworkResult['COL 1']}', '{$courseworkResult['COL 2']}', '{$courseworkResult['COL 3']}', '{$courseworkResult['COL 4']}',
                    '{$courseworkResult['COL 5']}', '{$courseworkResult['COL 6']}', '{$courseworkResult['COL 7']}', '{$courseworkResult['COL 8']}', 
                    '{$courseworkResult['COL 9']}', '{$courseworkResult['COL 10']}', '{$courseworkResult['COL 11']}', '{$courseworkResult['COL 12']}',
                    '{$courseworkResult['COL 13']}', '{$courseworkResult['COL 14']}', '{$courseworkResult['COL 15']}', '{$courseworkResult['COL 16']}', 
                    '{$courseworkResult['COL 17']}', '{$courseworkResult['COL 18']}', '{$courseworkResult['COL 19']}', '{$courseworkResult['COL 20']}', 
                    '{$courseworkResult['COL 21']}', '{$courseworkResult['COL 22']}', '{$courseworkResult['COL 23']}', '{$courseworkResult['COL 24']}',
                    '{$courseworkResult['COL 25']}', '{$courseworkResult['COL 26']}', '{$courseworkResult['COL 27']}', '{$courseworkResult['COL 28']}',
                    '{$courseworkResult['COL 29']}', '{$courseworkResult['COL 30']}', '{$courseworkResult['COL 31']}', '{$courseworkResult['COL 32']}',
                    '{$courseworkResult['COL 33']}', '{$courseworkResult['COL 34']}', '{$courseworkResult['COL 35']}', '{$courseworkResult['COL 36']}', 
                    '{$courseworkResult['COL 37']}', '{$courseworkResult['COL 38']}', '{$courseworkResult['COL 39']}', '{$courseworkResult['COL 40']}', 
                    '{$courseworkResult['COL 41']}', '{$courseworkResult['COL 42']}', '{$courseworkResult['COL 43']}'
                    )"
            );
            $query = mysqli_query($this->linki, $sql);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
    }

    public function courseworkResultReject(string $coursework, string $courseworkResultId, UserInterface $prepod): void
    {
        try{
            $sql = sprintf("UPDATE `сoursework_result_{$coursework}` SET `status`= -1, `id_prepod`= '{$prepod->getId()}', `COL 4`= '{$prepod->getFio()}', `COL 5`= '2' WHERE `id` = '{$courseworkResultId}'");
            $query = mysqli_query($this->linki, $sql);
        } catch (\Exception $exception) {
            $courseworkResult = null;
        }
    }

    public function findCourseworkUser(Coursework $coursework, UserInterface $user): ?array
    {
        $sql = sprintf("SELECT * FROM `сoursework_result_{$coursework->getId()}` WHERE `id_user` = '{$user->getId()}' AND `status` = 1");
        $query = mysqli_query($this->linki, $sql);
        $result = mysqli_fetch_array($query);

        if($result) {
            return $result;
        }

        $sql = sprintf("SELECT * FROM `сoursework_result_{$coursework->getId()}` WHERE `id_user` = '{$user->getId()}' AND `status` = 0");
        $query = mysqli_query($this->linki, $sql);
        $result = mysqli_fetch_array($query);

        if($result) {
            return $result;
        }

        $sql = sprintf("SELECT * FROM `сoursework_result_{$coursework->getId()}` WHERE `id_user` = '{$user->getId()}' AND `status` = -1");
        $query = mysqli_query($this->linki, $sql);
        $result = mysqli_fetch_array($query);

        if($result) {
            return $result;
        }

        $result['status'] = 'none';

        return $result;
    }
}
