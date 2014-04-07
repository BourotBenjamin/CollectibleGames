<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VersionConsoleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('region',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Region', 'property' => 'name', 'multiple' => false))
			->add('photo', 'file', array('required'  => false))
			->add('reference_console',        'text', array('required'  => false))
			->add('code_barre_console',        'text', array('required'  => false))
			->add('date_sortie_console',        'text', array('required'  => false,'attr' => array('class' => 'datepicker', 'type' => 'text')))
			->add('prix',        'integer', array('required'  => false))
			->add('remarque_version_console',        'textarea', array('required'  => false))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\VersionConsole'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_versionconsoletype';
  }
}
?>