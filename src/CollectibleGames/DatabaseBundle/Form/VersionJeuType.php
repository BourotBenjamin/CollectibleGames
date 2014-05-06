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
			->add($builder->create('region', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Region','class'=>'region'), 'required' => false))->addModelTransformer(new RegionToNameTransformer($options['em'])))
			->add($builder->create('edition', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Edition','class'=>'edition'), 'required' => false))->addModelTransformer(new EditionToNameTransformer($options['em'])))
			->add($builder->create('editeur', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Editeur','class'=>'editeur'), 'required' => false))->addModelTransformer(new EditeurToNameTransformer($options['em'])))
			->add($builder->create('format', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Format (ex : PAL)','class'=>'format'), 'required' => false))->addModelTransformer(new FormatToNameTransformer($options['em'])))
			->add($builder->create('support', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Support (ex : DVD)','class'=>'support'), 'required' => false))->addModelTransformer(new SupportToNameTransformer($options['em'])))
			->add($builder->create('langues_jeu', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Langues','class'=>'langues'), 'required' => false))->addModelTransformer(new LanguesToNameTransformer($options['em'])))
			->add('autre_nom_jeu',       'text', array('label'=>" ",'attr' => array('placeholder'=>'Vendu sous le nom ...'), 'required' => false))
			->add('photoBoite', 'file', array('label'=>"Photo de la boite ",'required'  => false))
			->add('photoDosBoite', 'file', array('label'=>"Photo du dos de la boite ",'required'  => false))
			->add('photoLoose', 'file', array('label'=>"Photo du jeu en loose ",'required'  => false))
			->add('photoNotice', 'file', array('label'=>"Photo de la notice ",'required'  => false))
			->add('photoMisc', 'file', array('label'=>"Photo du contenu complet ",'required'  => false))
			->add('date_sortie_jeu',        'text' , array('label'=>"Date de sortie ", 'required'  => false,  'attr' => array('class' => 'date datepicker', 'type' => 'text')))
			->add('reference_jeu',        'text', array('label'=>" ", 'attr' => array('placeholder'=>'Référence'), 'required'  => false))
			->add('code_barre_jeu',        'text', array('label'=>" ", 'attr' => array('placeholder'=>'Code barre'), 'required'  => false))
			->add('accessoires',       'entity', array('label'=>" ", 'attr' => array('placeholder'=>'Accessoires inclus', 'class'=>'accessoires'), 'class'    => 'CollectibleGamesDatabaseBundle:Accessoire', 'multiple' => true, 'required' => false))
			->add('remarque_version_jeu',        'textarea', array('label'=>" ", 'attr' => array('placeholder'=>'Remarque sur la version'), 'required'  => false));
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