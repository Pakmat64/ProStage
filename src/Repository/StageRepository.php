<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stage::class);
    }

     /**
     * @return Stage[] Returns an array of Stage objects
      */

    public function findByNomEntreprise($nomEntreprise)
    {
        return $this->createQueryBuilder('s')
            ->join('s.entreprise','e')
            ->andWhere('e.intitule = :nom')
            ->setParameter('nom', $nomEntreprise)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Stage[] Returns an array of Stage objects
     */

   public function findAllWithEntreprise()
   {
       return $this->getEntityManager()->createQuery('SELECT s, e
         FROM App\Entity\Stage s
          JOIN s.entreprise e')->execute();

   }


    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
