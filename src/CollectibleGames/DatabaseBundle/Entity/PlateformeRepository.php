<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PlateformeRepository extends EntityRepository
{
    public function findAllNames()
    { 
        $r =  $this->getEntityManager()
            ->createQuery(
                'SELECT p.name 
				FROM CollectibleGamesDatabaseBundle:Plateforme p '
            )
            ->getResult();
		$n = array();
		foreach($r as $name)
		{
			$n[$name['name']] = $name['name'];
		}
		return $n;
    }
	
    public function findByCollection($u)
    { 
        $p =  $this->getEntityManager()
            ->createQuery(
                'SELECT plateforme FROM CollectibleGamesDatabaseBundle:Plateforme plateforme
				WHERE plateforme.id in ( SELECT p.id
				FROM CollectibleGamesCollectionBundle:CollectionJeu j
				JOIN j.jeu jeu 
				JOIN jeu.plateforme p 
				WHERE j.user = :User )
				OR plateforme.id IN (SELECT p2.id
				FROM CollectibleGamesCollectionBundle:CollectionConsole c
				JOIN c.console console 
				JOIN console.plateforme p2
				WHERE c.user = :User)
				OR plateforme.id IN (SELECT p3.id
				FROM CollectibleGamesCollectionBundle:CollectionAccessoire a
				JOIN a.accessoire accessoire 
				JOIN accessoire.plateforme p3 
				WHERE a.user = :User)'
            )->setParameter('User', $u)
            ->getResult();
		return $p;
    }
}