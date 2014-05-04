<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class JeuRepository extends EntityRepository
{
    public function findByPartialName($name)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT j
				FROM CollectibleGamesDatabaseBundle:Jeu j 
				WHERE j.name LIKE :Name'
            )
			->setParameter('Name', '%'.$name.'%')
            ->getResult();
    }
}