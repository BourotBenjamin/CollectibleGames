<?php

namespace CollectibleGames\CollectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use CollectibleGames\CollectionBundle\Entity\CollectionJeu;
use CollectibleGames\CollectionBundle\Form\CollectionJeuType;
use CollectibleGames\CollectionBundle\Entity\CollectionAccessoire;
use CollectibleGames\CollectionBundle\Form\CollectionAccessoireType;
use CollectibleGames\CollectionBundle\Entity\CollectionConsole;
use CollectibleGames\CollectionBundle\Form\CollectionConsoleType;
use CollectibleGames\CollectionBundle\Entity\Album;
use CollectibleGames\CollectionBundle\Form\AlbumType;
use CollectibleGames\CollectionBundle\Entity\Photo;
use CollectibleGames\CollectionBundle\Form\PhotoType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/collection/add_games", name="collection_add_games")
     * @Template("CollectibleGamesCollectionBundle:Default:add_jeu.html.twig")
     */
    public function addGameAction(Request $request)
    {
		if ($request->getMethod() == 'POST') {
			if($request->request->get('jeux')>0)
			{
				$jeux = $request->request->get('jeux');
				$em = $this->getDoctrine()->getManager();
				$id = array_values($jeux)[0];
				$jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
				while($jeu->getVersions()->isEmpty() && count($jeux)!=0)
				{
					unset($jeux[array_values($jeux)[0]]);
				}
				if(count($jeux)==0)
				{
					return $this->redirect($this->generateUrl('own_collection'));
				}
				else
				{
					$id = array_values($jeux)[0];
					$jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
				}
				$collection_jeu = new CollectionJeu();
				$cjt = new CollectionJeuType();
				$cjt->setJeu($id);
				$form = $this->createForm($cjt, $collection_jeu);
				if($request->request->has('jeu'))
				{
					$form->bind($request);
					if ($form->isValid()) {
						unset($jeux[$id]);
						$collection_jeu->setJeu($jeu);
						$collection_jeu->setUser($this->container->get('security.context')->getToken()->getUser());
						$em->persist($collection_jeu);
						$em->flush();
						if($request->request->has('applyToAll'))
						{
							$jeux_restants = array();
							foreach($jeux as $jeu)
							{
								$j = $collection_jeu->getVersion();
								$e = $j->getEdition();
								$r = $j->getRegion();
								$version = $em->getRepository('CollectibleGamesDatabaseBundle:VersionJeu')->findByGameRegionAndEdition($jeu, $r, $e);
								if($version)
								{
									$new = new CollectionJeu();
									$new->setUser($collection_jeu->getUser());
									$new->setJeu($version->getJeu());
									$new->setVersion($version);
									$new->setEtat($collection_jeu->getEtat());
									$new->setBoite($collection_jeu->getBoite());
									$new->setNotice($collection_jeu->getNotice());
									$new->setCartouche($collection_jeu->getCartouche());
									$new->setCale($collection_jeu->getCale());
									$new->setBlisterSouple($collection_jeu->getBlisterSouple());
									$new->setBlisterRigide($collection_jeu->getBlisterRigide());
									$new->setCommentaire($collection_jeu->getCommentaire());
									$em->persist($new);
								}
								else
								{
									$jeux_restants[] = $jeu;
								}							
							}
							$jeux = $jeux_restants;
							$em->flush();
						}
						if(count($jeux)>0)
						{
							$id = array_values($jeux)[0];
							$jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
							while($jeu->getVersions()->isEmpty() && count($jeux)!=0)
							{
								unset($jeux[array_values($jeux)[0]]);
							}
							if(count($jeux)==0)
							{
								return $this->redirect($this->generateUrl('own_collection'));
							}
							else
							{
								$id = array_values($jeux)[0];
								$jeu = $em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findOneById($id);
							}
							$collection_jeu = new CollectionJeu();
							$cjt = new CollectionJeuType();
							$cjt->setJeu($id);
							$form = $this->createForm($cjt, $collection_jeu);
						}
						else
						{
							return $this->redirect($this->generateUrl('own_collection'));
						}
					}
				}
				return array(
			'form' => $form->createView(),
			'jeux' => $jeux, 
			'jeu' => $jeu
			);
			}
		}
		return $this->redirect($this->generateUrl('own_collection'));
    }
	
	 /**
     * @Route("/collection/edit_games/{id}", name="collection_edit_games")
     * @Template("CollectibleGamesCollectionBundle:Default:edit_possession.html.twig")
     */
    public function editGameAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$c = $em->getRepository('CollectibleGamesCollectionBundle:CollectionJeu')->findOneById($id);
			if($c->getUser()->getId() == $u->getId())
			{
				$cjt = new CollectionJeuType();
				$cjt->setJeu($c->getJeu()->getId());
				$form = $this->createForm($cjt, $c);
				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
				  $form->bind($request);
				  if ($form->isValid()) {
					$em->persist($c);
					$em->flush();
					return $this->redirect($this->generateUrl('show_collection', array('id' => $c->getUser()->getId())));
				  }
				}	
				return $this->render('CollectibleGamesCollectionBundle:Default:modifier_possession.html.twig', array(
					'form' => $form->createView(),
					'title' => "Modifier ".$c->getJeu()->getName()->getName().' sur '.$c->getJeu()->getPlateforme()->getName(),
				));
			}
			else
			{
		return $this->render('::error.html.twig', array(
				'message' => "Vous n'avez pas l'autorisation de modifier ce jeu",
			));
			}
		}
		else
		{
		return $this->render('::error.html.twig', array(
				'message' => "Vous devez être connecté pour modifier un jeu",
			));
		}
    }
	
   
	 /**
     * @Route("/collection/remove_games/{id}", name="collection_remove_games", options={"expose"=true})
     */
    public function removeGameAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$c = $em->getRepository('CollectibleGamesCollectionBundle:CollectionJeu')->findOneById($id);
			if($c->getUser()->getId() == $u->getId())
			{
					$em->remove($c);
					$em->flush();
					return new Response("Ok");
			}
			else
			{
				return new Response("Bad");
			}
		}
		else
		{
				return new Response("Bad");
		}
    }
   
	 /**
     * @Route("/collection/remove_consoles/{id}", name="collection_remove_consoles", options={"expose"=true})
     */
    public function removeConsoleAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$c = $em->getRepository('CollectibleGamesCollectionBundle:CollectionConsole')->findOneById($id);
			if($c->getUser()->getId() == $u->getId())
			{
					$em->remove($c);
					$em->flush();
					return new Response("Ok");
			}
			else
			{
				return new Response("Bad");
			}
		}
		else
		{
				return new Response("Bad");
		}
    }
   
	 /**
     * @Route("/collection/remove_accessoires/{id}", name="collection_remove_accessoires", options={"expose"=true})
     */
    public function removeAccessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$c = $em->getRepository('CollectibleGamesCollectionBundle:CollectionAccessoire')->findOneById($id);
			if($c->getUser()->getId() == $u->getId())
			{
					$em->remove($c);
					$em->flush();
					return new Response("Ok");
			}
			else
			{
				return new Response("Bad");
			}
		}
		else
		{
				return new Response("Bad");
		}
    }
	
    /**
     * @Route("/collection/add_consoles", name="collection_add_consoles")
     * @Template("CollectibleGamesCollectionBundle:Default:add_console.html.twig")
     */
    public function addConsoleAction(Request $request)
    {
		if ($request->getMethod() == 'POST') {
			if($request->request->get('consoles')>0)
			{
				$consoles = $request->request->get('consoles');
				$em = $this->getDoctrine()->getManager();
				$id = array_values($consoles)[0];
				$console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
				while($console->getVersions()->isEmpty() && count($consoles)!=0)
				{
					unset($consoles[array_values($consoles)[0]]);
				}
				if(count($consoles)==0)
				{
					return $this->redirect($this->generateUrl('own_collection'));
				}
				else
				{
					$id = array_values($consoles)[0];
					$console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
				}
				$collection_console = new CollectionConsole();
				$cjt = new CollectionConsoleType();
				$cjt->setConsole($id);
				$form = $this->createForm($cjt, $collection_console);
				if($request->request->has('console'))
				{
					$form->bind($request);
					if ($form->isValid()) {
						unset($consoles[$id]);
						$collection_console->setConsole($console);
						$collection_console->setUser($this->container->get('security.context')->getToken()->getUser());
						$em->persist($collection_console);
						$em->flush();
						if($request->request->has('applyToAll'))
						{
							$consoles_restantes = array();
							foreach($consoles as $console)
							{
								$c = $collection_console->getVersion();
								$r = $c->getRegion();
								$version = $em->getRepository('CollectibleGamesDatabaseBundle:VersionConsole')->findByConsoleAndRegion($console, $r);
								if($version)
								{
									$new = new CollectionConsole();
									$new->setUser($collection_console->getUser());
									$new->setConsole($version->getConsole());
									$new->setVersion($version);
									$new->setEtat($collection_console->getEtat());
									$new->setBoite($collection_console->getBoite());
									$new->setNotice($collection_console->getNotice());
									$new->setMachine($collection_console->getMachine());
									$new->setCale($collection_console->getCale());
									$new->setConsoleScelle($collection_console->getConsoleScelle());
									$new->setCommentaire($collection_console->getCommentaire());
									$em->persist($new);
								}
								else
								{
									$consoles_restantes[] = $console;
								}							
							}
							$consoles = $consoles_restantes;
							$em->flush();
						}
						if(count($consoles)>0)
						{
							$id = array_values($consoles)[0];
							$console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
							while($console->getVersions()->isEmpty() && count($consoles)!=0)
							{
								unset($consoles[array_values($consoles)[0]]);
							}
							if(count($consoles)==0)
							{
								return $this->redirect($this->generateUrl('own_collection'));
							}
							else
							{
								$id = array_values($consoles)[0];
								$console = $em->getRepository('CollectibleGamesDatabaseBundle:Console')->findOneById($id);
							}
							$collection_console = new CollectionConsole();
							$cjt = new CollectionConsoleType();
							$cjt->setConsole($id);
							$form = $this->createForm($cjt, $collection_console);
						}
						else
						{
							return $this->redirect($this->generateUrl('own_collection'));
						}
					}
				}
				return array(
			'form' => $form->createView(),
			'consoles' => $consoles, 
			'console' => $console
			);
			}
		}
		return $this->redirect($this->generateUrl('own_collection'));
    }
	
	 /**
     * @Route("/collection/edit_consoles/{id}", name="collection_edit_consoles")
     * @Template("CollectibleGamesCollectionBundle:Default:edit_possession.html.twig")
     */
    public function editConsoleAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$c = $em->getRepository('CollectibleGamesCollectionBundle:CollectionConsole')->findOneById($id);
			if($c->getUser()->getId() == $u->getId())
			{
				$cjt = new CollectionConsoleType();
				$cjt->setConsole($c->getConsole()->getId());
				$form = $this->createForm($cjt, $c);
				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
				  $form->bind($request);
				  if ($form->isValid()) {
					$em->persist($c);
					$em->flush();
					return $this->redirect($this->generateUrl('show_collection', array('id' => $c->getUser()->getId())));
				  }
				}	
				return $this->render('CollectibleGamesCollectionBundle:Default:modifier_possession.html.twig', array(
					'form' => $form->createView(),
					'title' => "Modifier ".$c->getConsole()->getName().' ('.$c->getConsole()->getPlateforme()->getName().')',
				));
			}
			else
			{
		return $this->render('::error.html.twig', array(
				'message' => "Vous n'avez pas l'autorisation de modifier cette console",
			));
			}
		}
		else
		{
		return $this->render('::error.html.twig', array(
				'message' => "Vous devez être connecté pour modifier une console",
			));
		}
    }
	
    /**
     * @Route("/collection/add_accessoires", name="collection_add_accessoires")
     * @Template("CollectibleGamesCollectionBundle:Default:add_accessoire.html.twig")
     */
    public function addAccessoireAction(Request $request)
    {
		if ($request->getMethod() == 'POST') {
			if($request->request->get('accessoires')>0)
			{
				$accessoires = $request->request->get('accessoires');
				$em = $this->getDoctrine()->getManager();
				$id = array_values($accessoires)[0];
				$accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
				while($accessoire->getVersions()->isEmpty() && count($accessoires)!=0)
				{
					unset($accessoires[array_values($accessoires)[0]]);
				}
				if(count($accessoires)==0)
				{
					return $this->redirect($this->generateUrl('own_collection'));
				}
				else
				{
					$id = array_values($accessoires)[0];
					$accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
				}
				$collection_accessoire = new CollectionAccessoire();
				$cjt = new CollectionAccessoireType();
				$cjt->setAccessoire($id);
				$form = $this->createForm($cjt, $collection_accessoire);
				if($request->request->has('accessoire'))
				{
					$form->bind($request);
					if ($form->isValid()) {
						unset($accessoires[$id]);
						$collection_accessoire->setAccessoire($accessoire);
						$collection_accessoire->setUser($this->container->get('security.context')->getToken()->getUser());
						$em->persist($collection_accessoire);
						$em->flush();
						if($request->request->has('applyToAll'))
						{
							$accessoires_restants = array();
							foreach($accessoires as $accessoire)
							{
								$a = $collection_accessoire->getVersion();
								$r = $a->getRegion();
								$version = $em->getRepository('CollectibleGamesDatabaseBundle:VersionAccessoire')->findByAccessoireAndRegion($accessoire, $r);
								if($version)
								{
									$new = new CollectionAccessoire();
									$new->setUser($collection_accessoire->getUser());
									$new->setAccessoire($version->getAccessoire());
									$new->setVersion($version);
									$new->setEtat($collection_accessoire->getEtat());
									$new->setBoite($collection_accessoire->getBoite());
									$new->setNotice($collection_accessoire->getNotice());
									$new->setMateriel($collection_accessoire->getMateriel());
									$new->setCale($collection_accessoire->getCale());
									$new->setBlisterSouple($collection_accessoire->getBlisterSouple());
									$new->setBlisterRigide($collection_accessoire->getBlisterRigide());
									$new->setCommentaire($collection_accessoire->getCommentaire());
									$em->persist($new);
								}
								else
								{
									$accessoires_restants[] = $accessoire;
								}							
							}
							$accessoires = $accessoires_restants;
							$em->flush();
						}
						if(count($accessoires)>0)
						{
							$id = array_values($accessoires)[0];
							$accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
							while($accessoire->getVersions()->isEmpty() && count($accessoires)!=0)
							{
								unset($accessoires[array_values($accessoires)[0]]);
							}
							if(count($accessoires)==0)
							{
								return $this->redirect($this->generateUrl('own_collection'));
							}
							else
							{
								$id = array_values($accessoires)[0];
								$accessoire = $em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findOneById($id);
							}
							$collection_accessoire = new CollectionAccessoire();
							$cjt = new CollectionAccessoireType();
							$cjt->setAccessoire($id);
							$form = $this->createForm($cjt, $collection_accessoire);
						}
						else
						{
							return $this->redirect($this->generateUrl('own_collection'));
						}
					}
				}
				return array(
			'form' => $form->createView(),
			'accessoires' => $accessoires, 
			'accessoire' => $accessoire
			);
			}
		}
		return $this->redirect($this->generateUrl('own_collection'));
    }
	
	 /**
     * @Route("/collection/edit_accessoires/{id}", name="collection_edit_accessoires")
     * @Template("CollectibleGamesCollectionBundle:Default:edit_possession.html.twig")
     */
    public function editAccessoireAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$c = $em->getRepository('CollectibleGamesCollectionBundle:CollectionAccessoire')->findOneById($id);
			if($c->getUser()->getId() == $u->getId())
			{
				$cjt = new CollectionAccessoireType();
				$cjt->setAccessoire($c->getAccessoire()->getId());
				$form = $this->createForm($cjt, $c);
				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
				  $form->bind($request);
				  if ($form->isValid()) {
					$em->persist($c);
					$em->flush();
					return $this->redirect($this->generateUrl('show_collection', array('id' => $c->getUser()->getId())));
				  }
				}	
				return $this->render('CollectibleGamesCollectionBundle:Default:modifier_possession.html.twig', array(
					'form' => $form->createView(),
					'title' => "Modifier ".$c->getAccessoire()->getName().' sur '.$c->getAccessoire()->getPlateforme()->getName(),
				));
			}
			else
			{
		return $this->render('::error.html.twig', array(
				'message' => "Vous n'avez pas l'autorisation de modifier cet accessoire",
			));
			}
		}
		else
		{
		return $this->render('::error.html.twig', array(
				'message' => "Vous devez être connecté pour modifier un accessoire",
			));
		}
    }
	
    /**
     * @Route("/collection", name="own_collection")
     * @Template("CollectibleGamesCollectionBundle:Default:collection.html.twig")
     */
	public function showOwnCollectionAction()
	{
		$u = $this->container->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getManager();
		$albums = $em->getRepository('CollectibleGamesCollectionBundle:Album')->findByUser($u);
		$jeux = $em->getRepository('CollectibleGamesCollectionBundle:CollectionJeu')->findByUserOrdered($u);
		$accessoires = $em->getRepository('CollectibleGamesCollectionBundle:CollectionAccessoire')->findByUserOrdered($u);
		$consoles = $em->getRepository('CollectibleGamesCollectionBundle:CollectionConsole')->findByUserOrdered($u);
		$plateformes = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findByCollection($u);
		return array(
			'user' => $u,
			'albums' => $albums,
			'jeux' => $jeux,
			'accessoires' => $accessoires,
			'consoles' => $consoles,
			'plateformes' => $plateformes
		);
	}
	
    /**
     * @Route("/collection/show/{id}", name="show_collection")
     * @Template("CollectibleGamesCollectionBundle:Default:collection.html.twig")
     */
	public function showCollectionAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$u = $em->getRepository('CollectibleGamesUserBundle:User')->find($id);
		$albums = $em->getRepository('CollectibleGamesCollectionBundle:Album')->findByUser($u);
		$jeux = $em->getRepository('CollectibleGamesCollectionBundle:CollectionJeu')->findByUserOrdered($u);
		$accessoires = $em->getRepository('CollectibleGamesCollectionBundle:CollectionAccessoire')->findByUserOrdered($u);
		$consoles = $em->getRepository('CollectibleGamesCollectionBundle:CollectionConsole')->findByUserOrdered($u);
		$plateformes = $em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findByCollection($u);
		return array(
			'user' => $u,
			'albums' => $albums,
			'jeux' => $jeux,
			'accessoires' => $accessoires,
			'consoles' => $consoles,
			'plateformes' => $plateformes
		);
	}
	
    /**
     * @Route("/album/show/{id}", name="show_album")
     * @Template("CollectibleGamesCollectionBundle:Default:album_photo.html.twig")
     */
	public function showAlbumAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$album = $em->getRepository('CollectibleGamesCollectionBundle:Album')->find($id);
		return array(
			'album' => $album
		);
	}
	
    /**
     * @Route("/memberlist", name="memberlist")
     * @Template("CollectibleGamesCollectionBundle:Default:member_list.html.twig")
     */
	public function showMemberListAction()
	{
		$em = $this->getDoctrine()->getManager();
		$membres = $em->getRepository('CollectibleGamesUserBundle:User')->findAll();
		return array(
			'membres' => $membres
		);
	}
	
    /**
     * @Route("/album/photo/add", name="add_photo")
     */
	public function addPhotoAction()
	{
		if (!empty($this->getRequest()->files)) {
			$u = $this->container->get('security.context')->getToken()->getUser();
			$uId = $this->getRequest()->request->get('user_id');
			if($uId==$u->getId())
			{			
				$em = $this->getDoctrine()->getManager();
				$tempFile = $this->getRequest()->files->get('file');
				$id = $this->getRequest()->request->get('id_album');
				$album = $em->getRepository('CollectibleGamesCollectionBundle:Album')->find($id);
				$photo = new Photo();
				$photo->setPhoto($tempFile);
				$photo->setAlbum($album);
				$photo->setDescription("");
				$photo->setName("");
				$photo->updatePhotosUrls();
				$em->persist($photo);
				ld($photo);
				$album->addPhotos($photo);
				$em->persist($album);
				ld($album);
				$em->flush();
			}
		}
		return new Response('Ok');
	}
	
	/**
     * @Route("/collection/create-album/", name="create_album")
     * @Template()
     */
    public function createAlbumAction()
    {
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$a = new Album();
			$form = $this->createForm(new AlbumType, $a);
			$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
			  $form->bind($request);
			  if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$a->setUser($u);
				$em->persist($a);
				$em->flush();
				return $this->redirect($this->generateUrl('show_album', array('id' => $a->getId())));
			  }
			}	
			return $this->render('CollectibleGamesCollectionBundle:Default:album_or_photo_form.html.twig', array(
				'form' => $form->createView(),
				'title' => "Créer un album",
			));
		}
		else
		{
		return $this->render('::error.html.twig', array(
				'message' => "Vous devez être connecté pour créer un album",
			));
		}
    }
	
	/**
     * @Route("/collection/edit-album/{id}", name="edit_album")
     * @Template()
     */
    public function editAlbumAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$album = $em->getRepository('CollectibleGamesCollectionBundle:Album')->find($id);
			if($album->getUser()->getId() == $u->getId())
			{
				$form = $this->createForm(new AlbumType, $album);
				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
				  $form->bind($request);
				  if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($album);
					$em->flush();
					return $this->redirect($this->generateUrl('show_album', array('id' => $album->getId())));
				  }
				}	
				return $this->render('CollectibleGamesCollectionBundle:Default:album_or_photo_form.html.twig', array(
					'form' => $form->createView(),
					'title' => "Modifier un album",
				));
			}
			else
			{
		return $this->render('::error.html.twig', array(
				'message' => "Vous n'avez pas l'autorisation de modifier cet album",
			));
			}
		}
		else
		{
		return $this->render('::error.html.twig', array(
				'message' => "Vous devez être connecté pour modifier un album",
			));
		}
    }
	
	/**
     * @Route("/collection/edit-photo/{id}", name="edit_photo")
     * @Template()
     */
    public function editPhotoAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$photo = $em->getRepository('CollectibleGamesCollectionBundle:Photo')->find($id);
			if($photo->getAlbum()->getUser()->getId() == $u->getId())
			{
				$form = $this->createForm(new PhotoType, $photo);
				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
				  $form->bind($request);
				  if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					if($photo->getCover())
					{
						$a = $photo->getAlbum();
						$a->setCover($photo);
						$em->persist($a);
					}
					$em->persist($photo);
					$em->flush();
					return $this->redirect($this->generateUrl('show_album', array('id' => $photo->getAlbum()->getId())));
				  }
				}	
				return $this->render('CollectibleGamesCollectionBundle:Default:album_or_photo_form.html.twig', array(
					'form' => $form->createView(),
					'title' => "Modifier une photo",
				));
			}
			else
			{
		return $this->render('::error.html.twig', array(
				'message' => "Vous n'avez pas l'autorisation de modifier cette photo",
			));
			}
		}
		else
		{
		return $this->render('::error.html.twig', array(
				'message' => "Vous devez être connecté pour modifier une photo",
			));
		}
    }
	 /**
     * @Route("/collection/remove_photo/{id}", name="collection_remove_photo", options={"expose"=true})
     */
    public function removePhotoAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $this->container->get('security.context')->getToken()->getUser();
		if($u)
		{
			$p = $em->getRepository('CollectibleGamesCollectionBundle:Photo')->findOneById($id);
			if($p->getAlbum()->getUser()->getId() == $u->getId())
			{
					if(is_file($p->getPhotoUrl()))
					{
						unlink($p->getPhotoUrl());
					}
					$em->remove($p);
					$em->flush();
					return new Response("Ok");
			}
			else
			{
				return new Response("Bad");
			}
		}
		else
		{
				return new Response("Bad");
		}
    }
	
	  /**
     * @Route("/collection/export/{id}", name="collection_export")
     */
    public function exportCollectionAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$u = $em->getRepository('CollectibleGamesUserBundle:User')->find($id);
		$jeux = $em->getRepository('CollectibleGamesCollectionBundle:CollectionJeu')->findByUser($u);
		$accessoires = $em->getRepository('CollectibleGamesCollectionBundle:CollectionAccessoire')->findByUser($u);
		$consoles = $em->getRepository('CollectibleGamesCollectionBundle:CollectionConsole')->findByUser($u);
        $handle = fopen('php://memory', 'r+');
        $header = array();
		fwrite($handle, "Collection de ".$u->getUsername()."\r\n\r\nPlateforme;Jeu;Blister Rigide;Blister Souple;Boite;Notice;Cale;Jeu;Etat;Commentaire;\r\n\r\n");
		foreach($jeux as $j)
		{
			fwrite($handle, $j->getJeu()->getPlateforme()->getName().';'.$j->getJeu()->getName().';');
			fwrite($handle, $j->getBlisterRigide()?'Oui;':'Non;');
			fwrite($handle, $j->getBlisterSouple()?'Oui;':'Non;');
			fwrite($handle, $j->getBoite()?'Oui;':'Non;');
			fwrite($handle, $j->getNotice()?'Oui;':'Non;');
			fwrite($handle, $j->getCale()?'Oui;':'Non;');
			fwrite($handle, $j->getCartouche()?'Oui;':'Non;');
			switch($j->getEtat())
			{
				case 0:
					fwrite($handle, 'Mauvais');
					break;
				case 1:
					fwrite($handle, 'Moyen');
					break;
				case 2:
					fwrite($handle, 'Bon');
					break;
				case 3:
					fwrite($handle, 'Très Bon');
					break;
				case 4:
					fwrite($handle, 'Neuf');
					break;
			}
			fwrite($handle, ';'.$j->getCommentaire()."\r\n");
		}
		fwrite($handle,  "\r\n\r\n");
		fwrite($handle,  "Plateforme;Console;Scellée;Boite;Notice;Cale;Console;Etat;Commentaire\r\n\r\n");
		foreach($consoles as $c)
		{
			fwrite($handle, $c->getConsole()->getPlateforme()->getName().';'.$c->getConsole()->getName().';');
			fwrite($handle, $c->getConsoleScelle()?'Oui;':'Non;');
			fwrite($handle, $c->getBoite()?'Oui;':'Non;');
			fwrite($handle, $c->getNotice()?'Oui;':'Non;');
			fwrite($handle, $c->getCale()?'Oui;':'Non;');
			fwrite($handle, $c->getMachine()?'Oui;':'Non;');
			switch($c->getEtat())
			{
				case 0:
					fwrite($handle, 'Mauvais');
					break;
				case 1:
					fwrite($handle, 'Moyen');
					break;
				case 2:
					fwrite($handle, 'Bon');
					break;
				case 3:
					fwrite($handle, 'Très Bon');
					break;
				case 4:
					fwrite($handle, 'Neuf');
					break;
			}
			fwrite($handle,  ';'.$c->getCommentaire()."\r\n");
		}
		fwrite($handle,  "\r\n\r\n");
		fwrite($handle,  "Plateforme;Accessoire;Blister Rigide;Blister Souple;Boite;Notice;Cale;Console;Etat;Commentaire\r\n\r\n");
		foreach($accessoires as $a)
		{
			fwrite($handle, $a->getAccessoire()->getPlateforme()->getName().';'.$a->getAccessoire()->getName().';');
			fwrite($handle, $a->getBlisterRigide()?'Oui;':'Non;');
			fwrite($handle, $a->getBlisterSouple()?'Oui;':'Non;');
			fwrite($handle, $a->getBoite()?'Oui;':'Non;');
			fwrite($handle, $a->getNotice()?'Oui;':'Non;');
			fwrite($handle, $a->getCale()?'Oui;':'Non;');
			fwrite($handle, $a->getMateriel()?'Oui;':'Non;');
			switch($a->getEtat())
			{
				case 0:
					fwrite($handle, 'Mauvais');
					break;
				case 1:
					fwrite($handle, 'Moyen');
					break;
				case 2:
					fwrite($handle, 'Bon');
					break;
				case 3:
					fwrite($handle, 'Très Bon');
					break;
				case 4:
					fwrite($handle, 'Neuf');
					break;
			}
			fwrite($handle, ';'.$a->getCommentaire()."\r\n");
		}
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="export.csv"'
        ));
    }
}
