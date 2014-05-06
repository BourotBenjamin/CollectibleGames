<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\VersionConsoleType;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\EditeurToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\PlateformeToNameTransformer;

class ConsoleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('name',        'text', array('label'=>" ", 'attr' => array('placeholder'=>"Nom de la console")))
			->add($builder->create('plateforme', 'text', array('label'=>" ", 'attr' => array('placeholder'=>"Plateforme", 'class'=>'plateforme'), 'required' => false))->addModelTransformer(new PlateformeToNameTransformer($options['em'])))
			->add($builder->create('editeur', 'text', array('label'=>" ", 'attr' => array('placeholder'=>"Editeur", 'class'=>'editeur'), 'required' => false))->addModelTransformer(new EditeurToNameTransformer($options['em'])))
			->add('remarque_console',        'textarea', array('label'=>" ", 'attr' => array('placeholder'=>"Remarque sur la console"), 'required'  => false))
			->add('versions', 'collection', array('type' => new VersionConsoleType(), 'options'  => array('em'=>$options['em']), 'allow_add' => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Console'
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
    return 'collectiblegames_databasebundle_consoletype';
  }
}
?>