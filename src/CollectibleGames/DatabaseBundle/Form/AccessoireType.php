<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\VersionAccessoireType;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\EditeurToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\PlateformeToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\TypeAccessoireToNameTransformer;

class AccessoireType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('name',        'text')
			->add($builder->create('plateforme', 'text', array('attr' => array('class'=>'plateforme'), 'required' => false))->addModelTransformer(new PlateformeToNameTransformer($options['em'])))
			->add($builder->create('editeur', 'text', array('attr' => array('class'=>'editeur'), 'required' => false))->addModelTransformer(new EditeurToNameTransformer($options['em'])))
			->add($builder->create('type', 'text', array('attr' => array('class'=>'type'), 'required' => false))->addModelTransformer(new TypeAccessoireToNameTransformer($options['em'])))
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