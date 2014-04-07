<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\VersionJeuType;

class JeuType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('name',        'entity', array('class'    => 'CollectibleGamesDatabaseBundle:NomJeu', 'property' => 'name', 'multiple' => false))
			->add('plateforme',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Plateforme', 'property' => 'name', 'multiple' => false))
			->add('type',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:TypeJeu', 'property' => 'name', 'multiple' => false))
			->add('groupe',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Groupe', 'property' => 'name', 'multiple' => false))
			->add('developpeur',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Developpeur', 'property' => 'name', 'multiple' => false))
			->add('commandes',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Commande', 'property' => 'name', 'multiple' => true))
			->add('autres_plateformes',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Plateforme', 'property' => 'name', 'multiple' => true))
			->add('nombre_joueurs',        'integer', array('required'  => false))
			->add('remarque_jeu',        'textarea', array('required'  => false))
			->add('accessoires',       'entity', array('class'    => 'CollectibleGamesDatabaseBundle:Accessoire', 'property' => 'name', 'multiple' => true))
			->add('versions', 'collection', array('type' => new VersionJeuType(), 'allow_add' => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Jeu'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_jeutype';
  }
}
?>