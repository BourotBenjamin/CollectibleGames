<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\Edition;

class EditionToNameTransformer implements DataTransformerInterface
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
        if (!$name || $name="") {
            return $this->om->getRepository('CollectibleGamesDatabaseBundle:Edition')->find(0);
        }

        $entity = $this->om
            ->getRepository('CollectibleGamesDatabaseBundle:Edition')
            ->findOneBy(array('name' => $name))
        ;

        if (null === $entity) {
            $entity = new Edition();
			$entity->setName($name);
			$this->om->persist($entity);
			$this->om->flush();			
        }
        return $entity;
    }
}