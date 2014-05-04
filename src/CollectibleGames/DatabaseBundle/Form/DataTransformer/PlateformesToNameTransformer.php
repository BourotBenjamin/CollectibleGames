<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\Plateforme;

class PlateformesToNameTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function transform($entity)
    {
        if (null === $entity) {
            return "";
        }

		$s ="";
		foreach($entity->toArray() as $e)
		{
			$s=$s.$e->getName().",";
		}
        return $s;
    }

    public function reverseTransform($string)
    {
		$names = split(",", $string);
		$plateformes = new \Doctrine\Common\Collections\ArrayCollection();
        if (!$string || count($names)==0) {
            return $plateformes;
        }
		
		foreach($names as $name)
		{
			$entity = $this->om
				->getRepository('CollectibleGamesDatabaseBundle:Plateforme')
				->findOneBy(array('name' => $name))
			;

			if (null === $entity) {
				$entity = new Plateforme();
				$entity->setEditeur($this->om->getRepository('CollectibleGamesDatabaseBundle:Editeur')->find(0));
				$entity->setName($name);
				$this->om->persist($entity);
				$this->om->flush();			
			}
			$plateformes[] = $entity;
		}
        return $plateformes;
    }
}