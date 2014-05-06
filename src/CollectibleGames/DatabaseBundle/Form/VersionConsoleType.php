<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\RegionToNameTransformer;

class VersionConsoleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add($builder->create('region', 'text', array('label'=>" ",'attr' => array('placeholder'=>'Region','class'=>'region'), 'required' => false))->addModelTransformer(new RegionToNameTransformer($options['em'])))
			->add('photo', 'file', array('label'=>"Photo ", 'required'  => false))
			->add('reference_console',        'text', array('label'=>" ",'attr' => array('placeholder'=>"Référence"), 'required'  => false))
			->add('code_barre_console',        'text', array('label'=>" ",'attr' => array('placeholder'=>"Code barre"), 'required'  => false))
			->add('date_sortie_console',        'text', array('label'=>"Date de sortie ",'attr' => array('class'=>'date'), 'required'  => false,'attr' => array('class' => 'datepicker', 'type' => 'text')))
			->add('prix',        'integer', array('label'=>" ",'attr' => array('placeholder'=>"Prix de vente d'origine"), 'required'  => false))
			->add('remarque_version_console',        'textarea', array('label'=>" ",'attr' => array('placeholder'=>"Remarque sur la version"), 'required'  => false))
			->add('accessoires',       'entity', array('label'=>" ",'attr' => array('placeholder'=>"Accessoires inclus", 'class'=>'accessoires'), 'class'    => 'CollectibleGamesDatabaseBundle:Accessoire', 'multiple' => true, 'required'  => false))
			;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\VersionConsole'
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
    return 'collectiblegames_databasebundle_versionconsoletype';
  }
}
?>