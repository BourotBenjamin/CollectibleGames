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
			->add('name',        'text', array('label'=>" ", 'attr' => array('placeholder'=>"Nom de l'accessoire")))
			->add($builder->create('plateforme', 'text', array('label'=>" ", 'attr' => array('placeholder'=>"Plateforme", 'class'=>'plateforme'), 'required' => false))->addModelTransformer(new PlateformeToNameTransformer($options['em'])))
			->add($builder->create('editeur', 'text', array('label'=>" ", 'attr' => array('placeholder'=>"Editeur", 'class'=>'editeur'), 'required' => false))->addModelTransformer(new EditeurToNameTransformer($options['em'])))
			->add($builder->create('type', 'text', array('label'=>" ", 'attr' => array('placeholder'=>"Type d'accessoire", 'class'=>'type'), 'required' => false))->addModelTransformer(new TypeAccessoireToNameTransformer($options['em'])))
			->add('zone', 'choice', array('label'=>"Zoné ",'attr' => array('placeholder'=>"Zone", 'class'=>"zone"),'choices' => array(1 => 'Oui', 0 => 'Non'), 'required'  => false,))
			->add('remarque_accessoire',        'textarea', array('label'=>" ",'attr' => array('placeholder'=>"Remarque sur l'accessoire"), 'required'  => false))
			->add('versions', 'collection', array('type' => new VersionAccessoireType(), 'options'  => array('em'=>$options['em']), 'allow_add' => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Accessoire'
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
    return 'collectiblegames_databasebundle_accessoiretype';
  }
}
?>