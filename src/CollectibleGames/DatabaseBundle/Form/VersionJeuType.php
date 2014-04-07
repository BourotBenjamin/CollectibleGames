<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VersionJeuType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('region',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Region', 'property' => 'name', 'multiple' => false))
			->add('edition',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Edition', 'property' => 'name', 'multiple' => false))
			->add('editeur',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Editeur', 'property' => 'name', 'multiple' => false))
			->add('format',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Format', 'property' => 'name', 'multiple' => false))
			->add('support',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Support', 'property' => 'name', 'multiple' => false))
			->add('langues_jeu',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Langue', 'property' => 'name', 'multiple' => true))
			->add('autre_nom_jeu',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:NomJeu', 'property' => 'name', 'multiple' => true))
			->add('photoBoite', 'file', array('required'  => false))
			->add('photoDosBoite', 'file', array('required'  => false))
			->add('photoLoose', 'file', array('required'  => false))
			->add('photoNotice', 'file', array('required'  => false))
			->add('photoMisc', 'file', array('required'  => false))
			->add('date_sortie_jeu',        'text' , array('required'  => false,  'attr' => array('class' => 'datepicker', 'type' => 'text')))
			->add('remarque_version_jeu',        'textarea', array('required'  => false))
			->add('reference_jeu',        'text', array('required'  => false))
			->add('code_barre_jeu',        'text', array('required'  => false))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\VersionJeu'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_versionjeutype';
  }
}
?>