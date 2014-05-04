<?php

namespace CollectibleGames\CollectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CollectionConsoleType extends AbstractType
{

  private $c=0;
  
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
		$builder
			->add('version',        'entity', array('class' => 'CollectibleGamesDatabaseBundle:VersionConsole',
			'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('v')
					->where('v.console = '.$this->c );
			},
			'property' => 'name', 'multiple' => false))
			->add('etat',       'choice', array('choices' => array
			(
				0 => 'Mauvais', 
				1 => 'Moyen', 
				2 => 'Bon', 
				3 => 'Très Bon', 
				4 => 'Neuf' 
			)
			,  'empty_value' => 'Choisissez une option', 'multiple' => false))
			->add('boite',        'checkbox', array('required'  => false))
			->add('notice',        'checkbox', array('required'  => false))
			->add('machine',        'checkbox', array('required'  => false))
			->add('cale',        'checkbox', array('required'  => false))
			->add('console_scelle',        'checkbox', array('required'  => false))
			->add('commentaire',        'textarea', array('required'  => false))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\CollectionBundle\Entity\CollectionConsole'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_collectionbundle_collectionconsoletype';
  }
  public function setConsole($console)
  {
    $this->c = $console;;
  }
}
?>