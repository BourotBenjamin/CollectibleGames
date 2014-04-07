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

class AccessoireController extends Controller
{

	/**
     * @Route("/bddjv/accessoire/{id}", name="show_accessoire")
     * @Template("CollectibleGamesDatabaseBundle:Default:accessoire.html.twig")
     */
    public function accessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
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
		$accessoire = new Accessoire();
		$form = $this->createForm(new AccessoireType, $accessoire);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
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
		));
    }
	/**
     * @Route("/bddjv/addVersionAccessoire/{id}", name="add_version_accessoire")
     * @Template()
     */
    public function addVersionAccessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$version = new VersionAccessoire();
        $accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
		$version->setAccessoire($accessoire);
		$form = $this->createForm(new VersionAccessoireType, $version);
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
		));
    }
	
	/**
     * @Route("/bddjv/editAccessoire/{id}", name="modifier_accessoire")
     * @Template()
     */
    public function editAccessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
		$form = $this->createForm(new AccessoireType, $accessoire);
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
		));
    }

}
