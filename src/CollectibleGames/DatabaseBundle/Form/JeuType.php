<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CollectibleGames\DatabaseBundle\Form\VersionJeuType;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\PlateformeToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\TypeJeuToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\GroupeToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\DeveloppeurToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\CommandesToNameTransformer;
use CollectibleGames\DatabaseBundle\Form\DataTransformer\PlateformesToNameTransformer;

class JeuType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
			->add('name',        'text', array('required'    => true))
			->add($builder->create('plateforme', 'text', array('attr' => array('class'=>'plateforme'), 'required' => false))->addModelTransformer(new PlateformeToNameTransformer($options['em'])))
			->add($builder->create('type', 'text', array('attr' => array('class'=>'type'), 'required' => false))->addModelTransformer(new TypeJeuToNameTransformer($options['em'])))
			->add($builder->create('groupe', 'text', array('attr' => array('class'=>'groupe'), 'required' => false))->addModelTransformer(new GroupeToNameTransformer($options['em'])))
			->add($builder->create('developpeur', 'text', array('attr' => array('class'=>'developpeur'), 'required' => false))->addModelTransformer(new DeveloppeurToNameTransformer($options['em'])))
			->add($builder->create('commandes', 'text', array('attr' => array('class'=>'commandes'), 'required' => false))->addModelTransformer(new CommandesToNameTransformer($options['em'])))
			->add($builder->create('autres_plateformes', 'text', array('attr' => array('class'=>'plateformes'), 'required' => false))->addModelTransformer(new PlateformesToNameTransformer($options['em'])))
			->add('nombre_joueurs',        'integer', array('required'  => false))
			->add('remarque_jeu',        'textarea', array('required'  => false))
			->add('versions', 'collection', array('type' => new VersionJeuType(), 'options'  => array('em'=>$options['em']), 'allow_add' => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Jeu'
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
    return 'collectiblegames_databasebundle_jeutype';
  }
}
?>