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

class GameController extends Controller
{
	
	/**
     * @Route("/bddjv/jeu/{id}", name="show_jeu")
     * @Template("CollectibleGamesDatabaseBundle:Default:jeu.html.twig")
     */
    public function jeuAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
        $plateforme = $jeu->getPlateforme();
        $editeur = $plateforme->getEditeur();
        return array(
		'plateforme'=>$plateforme,
		'jeu'=>$jeu,
		'editeur'=>$editeur,
		'modo'=>true
		);
    }	
	
	/**
     * @Route("/bddjv/createJeu/", name="create_jeu")
     * @Template()
     */
    public function createJeuAction()
    {
		$jeu = new Jeu();
		$form = $this->createForm(new JeuType, $jeu);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($jeu);
			$em->flush();
			foreach($jeu->getVersions() as $version)
			{
				$version->setJeu($jeu);
				$version->updatePhotosUrls();
				$em->persist($version);
			}
			$em->flush();
			return $this->redirect($this->generateUrl('show_jeu', array('id' => $jeu->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_jeu.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	/**
     * @Route("/bddjv/editJeu/{id}", name="modifier_jeu")
     * @Template()
     */
    public function editJeuAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
		$form = $this->createForm(new JeuType, $jeu);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($jeu);
			$em->flush();
			foreach($jeu->getVersions() as $version)
			{
				$version->setJeu($jeu);
				$version->updatePhotosUrls();
				$em->persist($version);
			}
			$em->flush();
			return $this->redirect($this->generateUrl('show_jeu', array('id' => $jeu->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_jeu.html.twig', array(
			'form' => $form->createView(),
		));
    }
	/**
     * @Route("/bddjv/addVersionJeu/{id}", name="add_version_jeu")
     * @Template()
     */
    public function addVersionJeuAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$version = new VersionJeu();
        $jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
		$version->setJeu($jeu);
		$form = $this->createForm(new VersionJeuType, $version);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($version);
			$em->flush();
			$version->setJeu($jeu);
			$version->updatePhotosUrls();
			$em->persist($version);
			$em->flush();
			return $this->redirect($this->generateUrl('show_jeu', array('id' => $version->getJeu()->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_version_jeu.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
}
