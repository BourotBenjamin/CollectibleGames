<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\Region;

class RegionToNameTransformer implements DataTransformerInterface
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

        return $entity->getName();
    }

    public function reverseTransform($name)
    {
        if (!$name || $name=="") {
            return $this->om->getRepository('CollectibleGamesDatabaseBundle:Region')->find(0);
        }

        $entity = $this->om
            ->getRepository('CollectibleGamesDatabaseBundle:Region')
            ->findOneBy(array('name' => $name))
        ;

        if (null === $entity) {
            $entity = new Region();
			$entity->setName($name);
			$this->om->persist($entity);
			$this->om->flush();			
        }
        return $entity;
    }
}