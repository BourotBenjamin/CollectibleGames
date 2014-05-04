<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VersionConsoleRepository extends EntityRepository
{
    public function findByConsoleAndRegion($console, $region)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT v 
				FROM CollectibleGamesDatabaseBundle:VersionConsole v 
				WHERE v.console=:Console
				AND v.region=:Region'
            )
			->setParameter('Console', $console)
			->setParameter('Region', $region)
            ->getOneOrNullResult();
    }
}