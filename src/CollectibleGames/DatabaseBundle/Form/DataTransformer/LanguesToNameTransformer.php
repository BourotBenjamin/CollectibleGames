<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\Langue;

class LanguesToNameTransformer implements DataTransformerInterface
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
		$langues = new \Doctrine\Common\Collections\ArrayCollection();
        if (!$string || count($names)==0) {
            return $langues;
        }
		
		foreach($names as $name)
		{
			$entity = $this->om
				->getRepository('CollectibleGamesDatabaseBundle:Langue')
				->findOneBy(array('name' => $name))
			;

			if (null === $entity) {
				$entity = new Langue();
				$entity->setName($name);
				$this->om->persist($entity);
				$this->om->flush();			
			}
			$langues[] = $entity;
		}
        return $langues;
    }
}