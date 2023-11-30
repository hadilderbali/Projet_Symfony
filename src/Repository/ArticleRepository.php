<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\SearchHandler\SearchHandlerInterface;


/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
// src/Repository/ArticleRepository.php


class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findByMultiCriteria(?string $search, ?string $publishedAfter): array
    {
        $qb = $this->createQueryBuilder('a');

        if ($search) {
            $qb->andWhere('a.title LIKE :search OR a.content LIKE :search')
                ->setParameter('search', '%'.$search.'%');
        }

        if ($publishedAfter) {
            $qb->andWhere('a.date > :publishedAfter')
                ->setParameter('publishedAfter', new \DateTime($publishedAfter));
        }

        return $qb->getQuery()->getResult();
    }


//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
   /** public function findBySearch(string $text): array
   {
        return $this->createQueryBuilder('a')
          ->andWhere('a.content LIKE :val')
          ->setParameter('val', "%$text%")
           ->getQuery()
           ->getResult()
      ;
    }*/



}
