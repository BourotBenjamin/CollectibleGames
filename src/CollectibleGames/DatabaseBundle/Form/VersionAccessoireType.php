<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\RegionToNameTransformer;

class VersionAccessoireType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add($builder->create('region', 'text', array('attr' => array('class'=>'region'), 'required' => false))->addModelTransformer(new RegionToNameTransformer($options['em'])))
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