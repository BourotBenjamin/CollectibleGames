<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\TypeJeu;

class TypeJeuToNameTransformer implements DataTransformerInterface
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
            return $this->om->getRepository('CollectibleGamesDatabaseBundle:TypeJeu')->find(0);
        }

        $type = $this->om
            ->getRepository('CollectibleGamesDatabaseBundle:TypeJeu')
            ->findOneBy(array('name' => $name))
        ;

        if (null === $type) {
            $type = new TypeJeu();
			$type->setName($name);
			$this->om->persist($type);
			$this->om->flush();			
        }
        return $type;
    }
}