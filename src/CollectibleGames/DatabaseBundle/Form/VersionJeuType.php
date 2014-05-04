<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\RegionToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\EditionToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\EditeurToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\FormatToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\SupportToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\LanguesToNameTransformer;

class VersionJeuType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add($builder->create('region', 'text', array('attr' => array('class'=>'region'), 'required' => false))->addModelTransformer(new RegionToNameTransformer($options['em'])))
			->add($builder->create('edition', 'text', array('attr' => array('class'=>'edition'), 'required' => false))->addModelTransformer(new EditionToNameTransformer($options['em'])))
			->add($builder->create('editeur', 'text', array('attr' => array('class'=>'editeur'), 'required' => false))->addModelTransformer(new EditeurToNameTransformer($options['em'])))
			->add($builder->create('format', 'text', array('attr' => array('class'=>'format'), 'required' => false))->addModelTransformer(new FormatToNameTransformer($options['em'])))
			->add($builder->create('support', 'text', array('attr' => array('class'=>'support'), 'required' => false))->addModelTransformer(new SupportToNameTransformer($options['em'])))
			->add($builder->create('langues_jeu', 'text', array('attr' => array('class'=>'langues'), 'required' => false))->addModelTransformer(new LanguesToNameTransformer($options['em'])))
			->add('autre_nom_jeu',       'text', array('required' => false))
			->add('photoBoite', 'file', array('required'  => false))
			->add('photoDosBoite', 'file', array('required'  => false))
			->add('photoLoose', 'file', array('required'  => false))
			->add('photoNotice', 'file', array('required'  => false))
			->add('photoMisc', 'file', array('required'  => false))
			->add('date_sortie_jeu',        'text' , array('required'  => false,  'attr' => array('class' => 'datepicker', 'type' => 'text')))
			->add('remarque_version_jeu',        'textarea', array('required'  => false))
			->add('reference_jeu',        'text', array('required'  => false))
			->add('code_barre_jeu',        'text', array('required'  => false))
			->add('accessoires',       'entity', array('attr' => array('class'=>'accessoires'), 'class'    => 'CollectibleGamesDatabaseBundle:Accessoire', 'multiple' => true, 'required' => false))
			;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\VersionJeu'
    ));
    $resolver->setRequired(array(
        'em',
    ));

    $resolver->setAllowedTypes(array(
        'em' => 'Doctrine\Common\Persistence\ObjectManager',
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_versionjeutype';
  }
}
?>