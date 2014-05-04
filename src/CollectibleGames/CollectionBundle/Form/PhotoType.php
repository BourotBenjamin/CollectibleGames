<?php

namespace CollectibleGames\CollectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PhotoType extends AbstractType
{
  
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
		$builder
			->add('name',        'text', array('required'  => true))
			->add('description',        'text', array('required'  => false))
			->add('cover',        'checkbox', array('required'  => false, 'label'=>"Définir comme photo de couverture de l'album"))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\CollectionBundle\Entity\Photo'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_collectionbundle_phototype';
  }

}
?>