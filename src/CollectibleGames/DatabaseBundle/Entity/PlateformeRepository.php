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
}