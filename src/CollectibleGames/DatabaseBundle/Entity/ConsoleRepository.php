<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ConsoleRepository extends EntityRepository
{
    public function findByPartialName($name)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c
				FROM CollectibleGamesDatabaseBundle:Console c 
				WHERE c.name LIKE :Name'
            )
			->setParameter('Name', '%'.$name.'%')
            ->getResult();
    }
}