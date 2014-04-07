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

class ConsoleController extends Controller
{
   /**
     * @Route("/bddjv/console/{id}", name="show_console")
     * @Template("CollectibleGamesDatabaseBundle:Default:console.html.twig")
     */
    public function consoleAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
        $plateforme = $console->getPlateforme();
        $editeur = $plateforme->getEditeur();
        return array(
		'plateforme'=>$plateforme,
		'console'=>$console,
		'editeur'=>$editeur,
		'modo'=>true
		);
    }	
	
	/**
     * @Route("/bddjv/createConsole/", name="create_console")
     * @Template()
     */
    public function createConsoleAction()
    {
		$console = new Console();
		$form = $this->createForm(new ConsoleType, $console);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($console);
			$em->flush();
			foreach($console->getVersions() as $version)
			{
				$version->setConsole($console);
				$version->updatePhotosUrls();
				$em->persist($version);
			}
			$em->flush();
			return $this->redirect($this->generateUrl('show_console', array('id' => $console->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_console.html.twig', array(
			'form' => $form->createView(),
		));
    }
	/**
     * @Route("/bddjv/addVersionConsole/{id}", name="add_version_console")
     * @Template()
     */
    public function addVersionConsoleAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$version = new VersionConsole();
        $console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
		$version->setConsole($console);
		$form = $this->createForm(new VersionConsoleType, $version);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($version);
			$em->flush();
			$version->setConsole($console);
			$version->updatePhotosUrls();
			$em->persist($version);
			$em->flush();
			return $this->redirect($this->generateUrl('show_console', array('id' => $version->getConsole()->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_version_console.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	/**
     * @Route("/bddjv/editConsole/{id}", name="modifier_console")
     * @Template()
     */
    public function editConsoleAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
		$form = $this->createForm(new ConsoleType, $console);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($console);
			$em->flush();
			foreach($console->getVersions() as $version)
			{
				$version->setConsole($console);
				$version->updatePhotosUrls();
				$em->persist($version);
			}
			$em->flush();
			return $this->redirect($this->generateUrl('show_console', array('id' => $console->getId())));
		  }
		}	
		return $this->render('CollectibleGamesDatabaseBundle:Default:ajouter_console.html.twig', array(
			'form' => $form->createView(),
		));
    }
}
