<?php
namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CollectionConsoleRepository extends EntityRepository
{
    public function findByUserOrdered($u)
    { 
        $res =  $this->getEntityManager()
            ->createQuery(
                'SELECT collec 
				FROM CollectibleGamesCollectionBundle:CollectionConsole collec
				JOIN collec.console c
				WHERE collec.user = :User
				ORDER BY c.plateforme, c.name
				'
            )->setParameter('User', $u)
            ->getResult();
		return $res;
    }
}