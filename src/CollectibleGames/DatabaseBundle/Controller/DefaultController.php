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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template("CollectibleGamesDatabaseBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
		$sql = 'SELECT nom_jeu, id_jeu, photo_boite
		FROM bddjv_jeu
		NATURAL JOIN bddjv_nom_jeu
		NATURAL JOIN bddjv_version_jeu
		WHERE photo_boite != "img/inconnu.png"
		ORDER BY RAND()
		LIMIT 8';
		$conn = $this->container->get('database_connection');
		$jeux = $conn->query($sql);
		$user = $this->getRequest()->getSession()->get('user');
        return array('jeux'=>$jeux);
    }
	
	/**
     * @Route("/bddjv", name="bddjv")
     * @Template("CollectibleGamesDatabaseBundle:Default:database.html.twig")
     */
    public function databaseAction()
    {
		$em = $this->getDoctrine()->getManager();
        $editeurs = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
        return array(
		'editeurs'=>$editeurs, 
		"nbPlateformes" => 0, 
		"nbJeux" => 0, 
		"nbVersionsJeux" => 0, 
		"nbConsoles" => 0, 
		"nbVersionsConsoles" => 0,
		"nbAccessoires" => 0,
		"nbVersionsAccessoires" => 0
		);
    }
	
	/**
     * @Route("/bddjv/editeur/{id}", name="show_editeur")
     * @Template("CollectibleGamesDatabaseBundle:Default:editeur.html.twig")
     */
    public function editeurAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $editeur = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findOneById($id);
        $plateformes = $editeur->getPlateformes();
        return array(
		'plateformes'=>$plateformes,
		'editeur'=>$editeur,
		'modo'=>true
		);
    }
	
	/**
     * @Route("/bddjv/plateforme/{id}", name="show_plateforme")
     * @Template("CollectibleGamesDatabaseBundle:Default:plateforme.html.twig")
     */
    public function plateformeAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        $plateforme = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findOneById($id);
        $editeur = $plateforme->getEditeur();
        $jeux = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findByPlateforme($plateforme);
        $consoles = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findByPlateforme($plateforme);
        return array(
		'plateforme'=>$plateforme,
		'jeux'=>$jeux,
		'consoles'=>$consoles,
		'editeur'=>$editeur,
		'modo'=>true
		);
    }
	
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
	/**
     * @Route("/team", name="team")
     * @Template()
     */
    public function teamAction()
    {
		return $this->render('CollectibleGamesDatabaseBundle:Default:team.html.twig');
    }
	/**
     * @Route("/faq", name="faq")
     * @Template()
     */
    public function faqAction()
    {
		return $this->render('CollectibleGamesDatabaseBundle:Default:faq.html.twig');
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
	
	/**
     * @Route("/suggestion", name="suggestion")
     * @Template()
     */
    public function createSuggestionAction()
    {
		$em = $this->getDoctrine()->getManager();
        $suggestion = new Suggestion();
		$form = $this->createForm(new SuggestionType, $suggestion);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);
		  if ($form->isValid()) {
			$em->persist($suggestion);
			$em->flush();
		  }
		}	
		$suggestions = $em->getRepository('CollectibleGamesDatabaseBundle:Suggestion')->findAll();
		$suggestion = new Suggestion();
		$form = $this->createForm(new SuggestionType, $suggestion);
		return $this->render('CollectibleGamesDatabaseBundle:Default:suggestions.html.twig', array(
			'form' => $form->createView(),
			'suggestions'=> $suggestions,
		));
    }
}
