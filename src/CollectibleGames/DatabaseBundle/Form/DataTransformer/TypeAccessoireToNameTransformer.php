<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\TypeAccessoire;

class TypeAccessoireToNameTransformer implements DataTransformerInterface
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

    public function transform($type)
    {
        if (null === $type) {
            return "";
        }

        return $type->getName();
    }

    public function reverseTransform($name)
    {
        if (!$name || $name="") {
            return $this->om->getRepository('CollectibleGamesDatabaseBundle:TypeAccessoire')->find(0);
        }

        $type = $this->om
            ->getRepository('CollectibleGamesDatabaseBundle:TypeAccessoire')
            ->findOneBy(array('name' => $name))
        ;

        if (null === $type) {
            $type = new TypeAccessoire();
			$type->setName($name);
			$this->om->persist($type);
			$this->om->flush();			
        }
        return $type;
    }
}