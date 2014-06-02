<?php

namespace CollectibleGames\DatabaseBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class JeuAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'integer', array('label' => 'Id'))
            ->add('name', 'text', array('label' => 'Name'))
            ->add('plateforme', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Plateforme', 'property' => 'name'))
            ->add('type', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\TypeJeu', 'property' => 'name'))
            ->add('groupe', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Groupe', 'property' => 'name'))
            ->add('developpeur', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Developpeur', 'property' => 'name'))
            ->add('remarque_jeu', 'text', array('label' => 'Remarque'))
            ->add('valide')
             ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('plateforme')
            ->add('type')
            ->add('groupe')
            ->add('developpeur')
            ->add('remarque_jeu')
            ->add('valide')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('plateforme')
            ->add('type')
            ->add('groupe')
            ->add('developpeur')
            ->add('remarque_jeu')
            ->add('valide')
        ;
    }
}