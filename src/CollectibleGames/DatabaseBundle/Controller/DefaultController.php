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
		"counts" => array ("nbPlateformes" => 0, 
		"nbJeux" => 0, 
		"nbVersionsJeux" => 0, 
		"nbConsoles" => 0, 
		"nbVersionsConsoles" => 0,
		"nbAccessoires" => 0,
		"nbVersionsAccessoires" => 0)
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
        $accessoires = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findByPlateforme($plateforme);
        return array(
		'plateforme'=>$plateforme,
		'jeux'=>$jeux,
		'consoles'=>$consoles,
		'accessoires'=>$accessoires,
		'editeur'=>$editeur,
		'modo'=>true
		);
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
