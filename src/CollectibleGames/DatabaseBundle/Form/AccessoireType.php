<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\VersionAccessoireType;

class AccessoireType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('name',        'text')
			->add('plateforme',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Plateforme', 'property' => 'name', 'multiple' => false))
			->add('editeur',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Editeur', 'property' => 'name', 'multiple' => false))
			->add('type',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:TypeAccessoire', 'property' => 'name', 'multiple' => false))
			->add('zone', 'choice', array('choices' => array(1 => 'Oui', 0 => 'Non'), 'required'  => false,))
			->add('remarque_accessoire',        'textarea', array('required'  => false))
			->add('versions', 'collection', array('type' => new VersionAccessoireType(), 'allow_add' => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Accessoire'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_accessoiretype';
  }
}
?>