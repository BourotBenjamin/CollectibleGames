<?php

namespace CollectibleGames\CollectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AlbumType extends AbstractType
{
  
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
		$builder
			->add('name',        'text', array('required'  => true))
			->add('description',        'text', array('required'  => false))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\CollectionBundle\Entity\Album'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_collectionbundle_albumtype';
  }

}
?>