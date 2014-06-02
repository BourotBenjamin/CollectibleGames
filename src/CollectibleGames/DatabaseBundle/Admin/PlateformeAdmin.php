<?php

namespace CollectibleGames\DatabaseBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PlateformeAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'integer', array('label' => 'Id'))
            ->add('name', 'text', array('label' => 'Name'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('editeur', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Editeur', 'property' => 'name'))
            ->add('imageUrl', 'url', array('label' => 'image'))
            ->add('valide')
             ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('editeur')
            ->add('imageUrl')
            ->add('valide')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('description')
            ->add('editeur')
            ->add('imageUrl')
            ->add('valide')
        ;
    }
}