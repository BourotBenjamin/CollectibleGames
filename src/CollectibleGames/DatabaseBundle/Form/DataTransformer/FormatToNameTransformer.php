<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\Format;

class FormatToNameTransformer implements DataTransformerInterface
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
            return $this->om->getRepository('CollectibleGamesDatabaseBundle:Format')->find(0);
        }

        $entity = $this->om
            ->getRepository('CollectibleGamesDatabaseBundle:Format')
            ->findOneBy(array('name' => $name))
        ;

        if (null === $entity) {
            $entity = new Format();
			$entity->setName($name);
			$this->om->persist($entity);
			$this->om->flush();			
        }
        return $entity;
    }
}