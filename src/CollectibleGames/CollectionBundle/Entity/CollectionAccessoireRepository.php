<?php
namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CollectionAccessoireRepository extends EntityRepository
{
    public function findByUserOrdered($u)
    { 
        $res =  $this->getEntityManager()
            ->createQuery(
                'SELECT collec 
				FROM CollectibleGamesCollectionBundle:CollectionAccessoire collec
				JOIN collec.accessoire a
				WHERE collec.user = :User
				ORDER BY a.plateforme, a.type, a.name
				'
            )->setParameter('User', $u)
            ->getResult();
		return $res;
    }
}