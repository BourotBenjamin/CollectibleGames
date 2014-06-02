<?php

namespace CollectibleGames\DatabaseBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VersionAccessoireAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'integer', array('label' => 'Id'))
            ->add('accessoire', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Accessoire', 'property' => 'name'))
            ->add('region', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Region', 'property' => 'name'))
            ->add('photoUrl')
            ->add('remarque_version_accessoire', 'text', array('label' => 'Remarque'))
            ->add('prix')
            ->add('date_sortie_accessoire')
            ->add('reference_accessoire')
            ->add('code_barre_accessoire')
            ->add('valide')
             ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('accessoire')
            ->add('region')
            ->add('photoUrl')
            ->add('remarque_version_accessoire')
            ->add('prix')
            ->add('date_sortie_accessoire')
            ->add('reference_accessoire')
            ->add('code_barre_accessoire')
            ->add('valide')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('accessoire')
            ->add('region')
            ->add('photoUrl')
            ->add('remarque_version_accessoire')
            ->add('prix')
            ->add('date_sortie_accessoire')
            ->add('reference_accessoire')
            ->add('code_barre_accessoire')
            ->add('valide')
        ;
    }
}