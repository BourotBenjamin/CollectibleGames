<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VersionAccessoireRepository extends EntityRepository
{
    public function findByAccessoireAndRegion($accessoire, $region)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT v 
				FROM CollectibleGamesDatabaseBundle:VersionAccessoire v 
				WHERE v.accessoire=:Accessoire
				AND v.region=:Region'
            )
			->setParameter('Accessoire', $accessoire)
			->setParameter('Region', $region)
            ->getOneOrNullResult();
    }
}