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

    public function findByNomEntreprise($id)
    {
        return $this->createQueryBuilder('s')
            ->join('s.entreprise','e')
            ->Where('e.id = :ident')
            ->setParameter('ident', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Stage[] Returns an array of Stage objects
     */

   public function findAllOrderByEntreprise()
   {
       return $this->createQueryBuilder('s')
           ->join('s.entreprise','e')
           ->orderBy('e.intitule','DESC')
           ->getQuery()
           ->getResult()
       ;
   }

    /**
    * @return Stage[] Returns an array of Stage objects
     */

   public function findByDistinctNom()
   {
       return $this->createQueryBuilder('s')
          ->select('s','e')->distinct(true)
          ->leftJoin('s.entreprise','e')
          ->getQuery()
          ->getResult()
      ;
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
