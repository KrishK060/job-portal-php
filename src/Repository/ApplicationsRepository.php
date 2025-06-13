<?php

namespace App\Repository;

use App\Entity\Applications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @extends ServiceEntityRepository<Applications>
 *
 * @method Applications|null find($id, $lockMode = null, $lockVersion = null)
 * @method Applications|null findOneBy(array $criteria, array $orderBy = null)
 * @method Applications[]    findAll()
 * @method Applications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationsRepository extends ServiceEntityRepository
{
    private $security;
    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Applications::class);
        $this->security = $security;
    }

    public function add(Applications $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Applications $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // src/Repository/ApplicationsRepository.php

public function findByJobPosts($jobPosts)
{
    return $this->createQueryBuilder('a')
        ->andWhere('a.job IN (:jobPosts)')
        ->setParameter('jobPosts', $jobPosts)
        ->getQuery()
        ->getResult();
}


    //    public function findOneBySomeField($value): ?Applications
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
