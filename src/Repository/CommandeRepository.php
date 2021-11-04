<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function byFacture($utilisateur)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.client = :client')
            ->andWhere('u.valider = 1')
            ->andWhere('u.reference != 0')
            ->orderBy('u.id')
            ->setParameter('client', $utilisateur);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return int|mixed|string
     * @throws NonUniqueResultException
     */
   public function countAllCommandes()
   {
       $qb =$this->createQueryBuilder('u')
           ->select('COUNT(u.id) as value' );
       return $qb->getQuery()->getOneOrNullResult();
   }

    /**
     * @throws NonUniqueResultException
     */
    public function countCommandesToday()
    {
        $today = date('Y-m-d h:i:s', strtotime("-1 days"));
        $qb =$this->createQueryBuilder('c')
            ->select('COUNT(c.id) as value' )
            ->where('c.date >= :date')
            ->setParameter('date', $today);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getCommandesToday()
    {
        $date = date('Y-m-d h:i:s', strtotime("-7 days"));
        $today = new \DateTime('now');
        $qb =$this->createQueryBuilder('c')
            ->select('c')
            ->where('c.date BETWEEN :date AND :now')
            ->setParameter('date', $date)
            ->setParameter('now', $today);

        return $qb->getQuery()->getResult();
    }
}
