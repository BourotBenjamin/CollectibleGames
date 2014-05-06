<?php
namespace CollectibleGames\DatabaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use CollectibleGames\DatabaseBundle\Entity\Plateforme;

class PlateformeToNameTransformer implements DataTransformerInterface
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

    public function transform($plateforme)
    {
        if (null === $plateforme) {
            return "";
        }

        return $plateforme->getName();
    }

    public function reverseTransform($name)
    {
        if (!$name || $name=="") {
            return $this->om->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->find(0);
        }

        $plateforme = $this->om
            ->getRepository('CollectibleGamesDatabaseBundle:Plateforme')
            ->findOneBy(array('name' => $name))
        ;

        if (null === $plateforme) {
            $plateforme = new Plateforme();
			$plateforme->setName($name);
			$plateforme->setEditeur($this->om->getRepository('CollectibleGamesDatabaseBundle:Editeur')->find(0));
			$this->om->persist($plateforme);
			$this->om->flush();			
        }
        return $plateforme;
    }
}