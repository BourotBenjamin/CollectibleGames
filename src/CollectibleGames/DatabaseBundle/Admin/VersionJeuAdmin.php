<?php

namespace CollectibleGames\DatabaseBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VersionJeuAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'integer', array('label' => 'Id'))
            ->add('jeu', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Jeu', 'property' => 'name'))
            ->add('region', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Region', 'property' => 'name'))
            ->add('edition', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Edition', 'property' => 'name'))
            ->add('editeur', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Editeur', 'property' => 'name'))
            ->add('support', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Support', 'property' => 'name'))
            ->add('format', 'entity', array('class' => 'CollectibleGames\DatabaseBundle\Entity\Format', 'property' => 'name'))
            ->add('remarque_version_jeu', 'text', array('label' => 'Remarque'))
            ->add('code_barre_jeu', 'text', array('label' => 'Remarque'))
            ->add('photoBoiteUrl')
            ->add('photoDosBoiteUrl')
            ->add('photoNoticeUrl')
            ->add('photoLooseUrl')
            ->add('valide')
             ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('jeu')
            ->add('region')
            ->add('edition')
            ->add('editeur')
            ->add('support')
            ->add('format')
            ->add('remarque_version_jeu')
            ->add('code_barre_jeu')
            ->add('photoBoiteUrl')
            ->add('photoDosBoiteUrl')
            ->add('photoNoticeUrl')
            ->add('photoLooseUrl')
            ->add('valide')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('jeu')
            ->add('region')
            ->add('edition')
            ->add('editeur')
            ->add('support')
            ->add('format')
            ->add('remarque_version_jeu')
            ->add('code_barre_jeu')
            ->add('photoBoiteUrl')
            ->add('photoDosBoiteUrl')
            ->add('photoNoticeUrl')
            ->add('photoLooseUrl')
            ->add('valide')
        ;
    }
}