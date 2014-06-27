<?php

namespace CollectibleGames\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CollectibleGames\DatabaseBundle\Entity\Jeu;
use CollectibleGames\DatabaseBundle\Form\JeuType;
use CollectibleGames\DatabaseBundle\Entity\VersionJeu;
use CollectibleGames\DatabaseBundle\Form\VersionJeuType;
use CollectibleGames\DatabaseBundle\Entity\Console;
use CollectibleGames\DatabaseBundle\Form\ConsoleType;
use CollectibleGames\DatabaseBundle\Entity\VersionConsole;
use CollectibleGames\DatabaseBundle\Form\VersionConsoleType;
use CollectibleGames\DatabaseBundle\Entity\Accessoire;
use CollectibleGames\DatabaseBundle\Form\AccessoireType;
use CollectibleGames\DatabaseBundle\Entity\VersionAccessoire;
use CollectibleGames\DatabaseBundle\Form\VersionAccessoireType;
use CollectibleGames\DatabaseBundle\Entity\Suggestion;
use CollectibleGames\DatabaseBundle\Form\SuggestionType;
use CollectibleGames\DatabaseBundle\Form\SearchByNameType;

class AccessoireController extends Controller
{
	
	/**
     * @Route("/bddjv/search-accessoire/", name="search_accessoire")
     * @Template("CollectibleGamesDatabaseBundle:Default:simple_form.html.twig")
     */
    public function searchAction()
    {
		$request = $this->get('request');
		$form = $this->createForm(new SearchByNameType);
		if ($request->getMethod() == 'POST') {
			$em = $this->getDoctrine()->getManager();
			$src = $request->request->get('collectiblegames_databasebundle_searchtype')['name'];
			$accessoires = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findByPartialName($src);
			$collection = array();
			$user = $this->container->get('security.context')->getToken()->getUser();
			if($user && $user!="anon.")
			{
				$collection['accessoires'] = $user->getAccessoiresIdList();
			}
			else
			{	
				$collection['accessoires'] = array();
			}
			return $this->render('CollectibleGamesDatabaseBundle:Default:search_results_accessoire.html.twig', array(
				'accessoires' => $accessoires,
				'src' => $src,
				'collection' => $collection
			));
		}
		return array
		(
			'title' => "Rechercher un accessoire",
			'form' => $form->createView()
		);
    }
	

	/**
     * @Route("/bddjv/accessoire/{id}", name="show_accessoire")
     * @Template("CollectibleGamesDatabaseBundle:Default:accessoire.html.twig")
     */
    public function accessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneBy($id);
        $plateforme = $accessoire->getPlateforme();
        $editeur = $plateforme->getEditeur();
        return array(
		'plateforme'=>$plateforme,
		'accessoire'=>$accessoire,
		'editeur'=>$editeur,
		'modo'=>true
		);
    }	
	
	/**
     * @Route("/bddjv/createAccessoire/", name="create_accessoire")
     * @Template()
     */
    public function createAccessoireAction()
    {
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
        $autocomplete['types'] = $em->getRepository('CollectibleGamesDatabaseBundle:TypeAccessoire')->findAll();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
		$accessoire = new Accessoire();
		$form = $this->createForm(new AccessoireType, $accessoire, array('em' =>$em));
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($accessoire);
			$em->flush();
			foreach($accessoire->getVersions() as $version)
			{
				$version->setAccessoire($accessoire);
				$version->updatePhotosUrls();
				$em->persist($version);
			}
			$em->flush();
			return $this->redirect($this->generateUrl('show_accessoire', array('id' => $accessoire->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_accessoire.html.twig', array(
			'form' => $form->createView(),
			'autocomplete' => $autocomplete,
		));
    }
	/**
     * @Route("/bddjv/addVersionAccessoire/{id}", name="add_version_accessoire")
     * @Template()
     */
    public function addVersionAccessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
		$version = new VersionAccessoire();
        $accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
		$version->setAccessoire($accessoire);
		$form = $this->createForm(new VersionAccessoireType, $version, array('em' =>$em));
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($version);
			$em->flush();
			$version->setAccessoire($accessoire);
			$version->updatePhotosUrls();
			$em->persist($version);
			$em->flush();
			return $this->redirect($this->generateUrl('show_accessoire', array('id' => $version->getAccessoire()->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_version_accessoire.html.twig', array(
			'form' => $form->createView(),
			'autocomplete' => $autocomplete,
		));
    }
	
	/**
     * @Route("/bddjv/editAccessoire/{id}", name="modifier_accessoire")
     * @Template()
     */
    public function editAccessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
        $autocomplete['types'] = $em->getRepository('CollectibleGamesDatabaseBundle:TypeAccessoire')->findAll();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
        $accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
		$form = $this->createForm(new AccessoireType, $accessoire, array('em' =>$em));
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($accessoire);
			$em->flush();
			foreach($accessoire->getVersions() as $version)
			{
				$version->setAccessoire($accessoire);
				$version->updatePhotosUrls();
				$em->persist($version);
			}
			$em->flush();
			return $this->redirect($this->generateUrl('show_accessoire', array('id' => $accessoire->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_accessoire.html.twig', array(
			'form' => $form->createView(),
			'autocomplete' => $autocomplete,
		));
    }

}
