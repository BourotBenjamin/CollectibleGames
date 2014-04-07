<?php

namespace CollectibleGames\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SuggestionType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('description',        'textarea', array('required'  => true))
			->add('type',        'choice', array('choices' => array('1'=>'Bug', '2'=>'Suggestion'), 'required'  => true))
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CollectibleGames\DatabaseBundle\Entity\Suggestion'
    ));
  }

  public function getName()
  {
    return 'collectiblegames_databasebundle_suggestiontype';
  }
}
?>