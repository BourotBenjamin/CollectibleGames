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

class ConsoleController extends Controller
{
	
	/**
     * @Route("/bddjv/search-console/", name="search_console")
     * @Template("CollectibleGamesDatabaseBundle:Default:simple_form.html.twig")
     */
    public function searchAction()
    {
		$request = $this->get('request');
		$form = $this->createForm(new SearchByNameType);
		if ($request->getMethod() == 'POST') {
			$em = $this->getDoctrine()->getManager();
			$src = $request->request->get('collectiblegames_databasebundle_searchtype')['name'];
			$consoles = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findByPartialName($src);
			$collection = array();
			$user = $this->container->get('security.context')->getToken()->getUser();
			if($user)
			{
				$collection['consoles'] = $user->getConsolesIdList();
			}
			else
			{	
				$collection['consoles'] = array();
			}
			return $this->render('CollectibleGamesDatabaseBundle:Default:search_results_console.html.twig', array(
				'consoles' => $consoles,
				'src' => $src,
				'collection' => $collection
			));
		}
		return array
		(
			'title' => "Rechercher une console",
			'form' => $form->createView()
		);
    }
	
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
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
		$console = new Console();
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
	/**
     * @Route("/bddjv/addVersionConsole/{id}", name="add_version_console")
     * @Template()
     */
    public function addVersionConsoleAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
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
		$autocomplete = array();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
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
