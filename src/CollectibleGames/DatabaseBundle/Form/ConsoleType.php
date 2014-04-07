<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\VersionConsoleType;

class ConsoleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('name',        'text')
			->add('plateforme',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Plateforme', 'property' => 'name', 'multiple' => false))
			->add('editeur',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Editeur', 'property' => 'name', 'multiple' => false))
			->add('remarque_console',        'textarea', array('required'  => false))
			->add('jeux',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Jeu', 'property' => 'name.name', 'multiple' => true))
			->add('accessoires',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Accessoire', 'property' => 'name', 'multiple' => true))
			->add('versions', 'collection', array('type' => new VersionConsoleType(), 'allow_add' => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Console'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_consoletype';
  }
}
?>