<?php
namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CollectionJeuRepository extends EntityRepository
{
    public function findByUserOrdered($u)
    { 
        $res =  $this->getEntityManager()
            ->createQuery(
                'SELECT collec 
				FROM CollectibleGamesCollectionBundle:CollectionJeu collec
				JOIN collec.jeu j
				WHERE collec.user = :User
				ORDER BY j.plateforme, j.name
				'
            )->setParameter('User', $u)
            ->getResult();
		return $res;
    }
}