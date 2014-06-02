<?php

namespace CollectibleGames\DatabaseBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AccessoireAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'integer', array('label' => 'Id'))
            ->add('name', 'text', array('label' => 'Name'))
            ->add('plateforme', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Plateforme', 'property' => 'name'))
            ->add('editeur', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Editeur', 'property' => 'name'))
            ->add('type', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\TypeAccessoire', 'property' => 'name'))
            ->add('remarque_accessoire', 'text', array('label' => 'Remarque'))
            ->add('zone')
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
            ->add('editeur')
            ->add('type')
            ->add('remarque_accessoire')
            ->add('zone')
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
            ->add('editeur')
            ->add('type')
            ->add('remarque_accessoire')
            ->add('zone')
            ->add('valide')
        ;
    }
}