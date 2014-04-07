<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VersionAccessoireType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('region',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Region', 'property' => 'name', 'multiple' => false))
			->add('photo', 'file', array('required'  => false))
			->add('reference_accessoire',        'text', array('required'  => false))
			->add('code_barre_accessoire',        'text', array('required'  => false))
			->add('date_sortie_accessoire',        'text', array('required'  => false,'attr' => array('class' => 'datepicker', 'type' => 'text')))
			->add('prix',        'integer', array('required'  => false))
			->add('remarque_version_accessoire',        'textarea', array('required'  => false))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\VersionAccessoire'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_versionaccessoiretype';
  }
}
?>