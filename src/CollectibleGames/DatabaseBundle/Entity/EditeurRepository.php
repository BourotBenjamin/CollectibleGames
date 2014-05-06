<?php
namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EditeurRepository extends EntityRepository
{
    public function findByExistingPlateformes()
    { 
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e 
				FROM CollectibleGamesDatabaseBundle:Editeur e
				JOIN e.plateformes'
            )
            ->getResult();
    }
}