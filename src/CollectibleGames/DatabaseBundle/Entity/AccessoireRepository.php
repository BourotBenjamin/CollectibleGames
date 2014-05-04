<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AccessoireRepository extends EntityRepository
{
    public function findByPartialName($name)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
				FROM CollectibleGamesDatabaseBundle:Accessoire a
				WHERE a.name LIKE :Name'
            )
			->setParameter('Name', '%'.$name.'%')
            ->getResult();
    }
}