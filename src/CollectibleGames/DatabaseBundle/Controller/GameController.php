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

class GameController extends Controller
{
	
	/**
     * @Route("/bddjv/search-game/", name="search_game")
     * @Template("CollectibleGamesDatabaseBundle:Default:simple_form.html.twig")
     */
    public function searchAction()
    {
		$request = $this->get('request');
		$form = $this->createForm(new SearchByNameType);
		if ($request->getMethod() == 'POST') {
			$em = $this->getDoctrine()->getManager();
			$src = $request->request->get('collectiblegames_databasebundle_searchtype')['name'];
			$jeux = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findByPartialName($src);
			$collection = array();
			$user = $this->container->get('security.context')->getToken()->getUser();
			if($user && $user!="anon.")
			{
				$collection['jeux'] = $user->getJeuxIdList();
			}
			else
			{	
				$collection['jeux'] = array();
			}
			return $this->render('CollectibleGamesDatabaseBundle:Default:search_results_game.html.twig', array(
				'jeux' => $jeux,
				'src' => $src,
				'collection' => $collection
			));
		}
		return array
		(
			'title' => "Rechercher un jeu",
			'form' => $form->createView()
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
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
        $autocomplete['types'] = $em->getRepository('CollectibleGamesDatabaseBundle:TypeJeu')->findAll();
        $autocomplete['groupes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Groupe')->findAll();
        $autocomplete['developpeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Developpeur')->findAll();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Edition')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
        $autocomplete['formats'] = $em->getRepository('CollectibleGamesDatabaseBundle:Format')->findAll();
        $autocomplete['supports'] = $em->getRepository('CollectibleGamesDatabaseBundle:Support')->findAll();
        $autocomplete['langues'] = $em->getRepository('CollectibleGamesDatabaseBundle:Langue')->findAll();
        $autocomplete['commandes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Commande')->findAll();
		$jeu = new Jeu();
		$form = $this->createForm(new JeuType, $jeu, array('em' =>$em));
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
			'autocomplete' => $autocomplete,
		));
    }
	
	/**
     * @Route("/bddjv/editJeu/{id}", name="modifier_jeu")
     * @Template()
     */
    public function editJeuAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
        $autocomplete['types'] = $em->getRepository('CollectibleGamesDatabaseBundle:TypeJeu')->findAll();
        $autocomplete['groupes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Groupe')->findAll();
        $autocomplete['developpeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Developpeur')->findAll();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Edition')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
        $autocomplete['formats'] = $em->getRepository('CollectibleGamesDatabaseBundle:Format')->findAll();
        $autocomplete['supports'] = $em->getRepository('CollectibleGamesDatabaseBundle:Support')->findAll();
        $autocomplete['langues'] = $em->getRepository('CollectibleGamesDatabaseBundle:Langue')->findAll();
        $autocomplete['commandes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Commande')->findAll();
        $jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
		$form = $this->createForm(new JeuType, $jeu, array('em' =>$em));
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
			'autocomplete' => $autocomplete,
		));
    }
	/**
     * @Route("/bddjv/addVersionJeu/{id}", name="add_version_jeu")
     * @Template()
     */
    public function addVersionJeuAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$autocomplete = array();
        $autocomplete['regions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Region')->findAll();
        $autocomplete['editions'] = $em->getRepository('CollectibleGamesDatabaseBundle:Edition')->findAll();
        $autocomplete['editeurs'] = $em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll();
        $autocomplete['formats'] = $em->getRepository('CollectibleGamesDatabaseBundle:Format')->findAll();
        $autocomplete['supports'] = $em->getRepository('CollectibleGamesDatabaseBundle:Support')->findAll();
        $autocomplete['langues'] = $em->getRepository('CollectibleGamesDatabaseBundle:Langue')->findAll();
        $autocomplete['commandes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Commande')->findAll();
        $autocomplete['plateformes'] = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll();
		$version = new VersionJeu();
        $jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
		$version->setJeu($jeu);
		$form = $this->createForm(new VersionJeuType, $version, array('em' =>$em));
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
			'autocomplete' => $autocomplete,
		));
    }
	
}
