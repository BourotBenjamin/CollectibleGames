<?php

namespace CollectibleGames\UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
			$builder->add('avatar', 'file', array('required'  => false));
    }

    public function getName()
    {
        return 'collectiblegames_user_profile';
    }
}