<?php

namespace CollectibleGames\DatabaseBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VersionConsoleAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'integer', array('label' => 'Id'))
            ->add('console', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Console', 'property' => 'name'))
            ->add('region', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Region', 'property' => 'name'))
            ->add('photoUrl')
            ->add('remarque_version_console', 'text', array('label' => 'Remarque'))
            ->add('prix')
            ->add('date_sortie_console')
            ->add('reference_console')
            ->add('code_barre_console')
            ->add('valide')
             ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('console')
            ->add('region')
            ->add('photoUrl')
            ->add('remarque_version_console')
            ->add('prix')
            ->add('date_sortie_console')
            ->add('reference_console')
            ->add('code_barre_console')
            ->add('valide')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('console')
            ->add('region')
            ->add('photoUrl')
            ->add('remarque_version_console')
            ->add('prix')
            ->add('date_sortie_console')
            ->add('reference_console')
            ->add('code_barre_console')
            ->add('valide')
        ;
    }
}