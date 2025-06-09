<?php

namespace App\Repository;

use App\Entity\JobSeekerProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobSeekerProfile>
 *
 * @method JobSeekerProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobSeekerProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobSeekerProfile[]    findAll()
 * @method JobSeekerProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobSeekerProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobSeekerProfile::class);
    }

    public function add(JobSeekerProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JobSeekerProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return JobSeekerProfile[] Returns an array of JobSeekerProfile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobSeekerProfile
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
