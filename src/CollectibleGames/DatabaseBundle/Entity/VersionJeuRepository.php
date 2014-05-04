<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VersionJeuRepository extends EntityRepository
{
    public function findByGameRegionAndEdition($game, $region, $edition)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT v 
				FROM CollectibleGamesDatabaseBundle:VersionJeu v 
				WHERE v.jeu=:Jeu
				AND v.region=:Region
				AND v.edition=:Edition'
            )
			->setParameter('Jeu', $game)
			->setParameter('Region', $region)
			->setParameter('Edition', $edition)
            ->getOneOrNullResult();
    }
}