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
use phpDocumentor\Reflection\Types\Mixed_;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

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
}
