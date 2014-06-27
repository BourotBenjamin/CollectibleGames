<?php

namespace CollectibleGames\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends Controller
{

    /**
     * @Route("/sitemap.{_format}", name="sample_sitemaps_sitemap", Requirements={"_format" = "xml"})
     * @Template()
     */
    public function sitemapAction() 
    {
		$response = new Response();
		$response->headers->set('Content-Type', 'xml');
        $em = $this->getDoctrine()->getManager();
        $urls = array();
        $hostname = "http://collectible-games.com";
        // add some urls homepage

			$urls[] = array('loc' => $this->get('router')->generate('index'), 'changefreq' => 'weekly', 'priority' => '1.0');
			$urls[] = array('loc' => $this->get('router')->generate('team'), 'changefreq' => 'weekly', 'priority' => '0.5');
			$urls[] = array('loc' => $this->get('router')->generate('faq'), 'changefreq' => 'weekly', 'priority' => '0.5');
			$urls[] = array('loc' => $this->get('router')->generate('suggestion'), 'changefreq' => 'weekly', 'priority' => '0.5');
			$urls[] = array('loc' => $this->get('router')->generate('memberlist'), 'changefreq' => 'weekly', 'priority' => '0.5');
        
        // service
		$i=0;
        foreach ($em->getRepository('CollectibleGamesDatabaseBundle:Editeur')->findAll() as $editeur) {
            $urls[] = array('loc' => $this->get('router')->generate('show_editeur', array('id' => $editeur->getId())), 'changefreq' => 'weekly', 'priority' => '0.7');
        }
        foreach ($em->getRepository('CollectibleGamesDatabaseBundle:Plateforme')->findAll() as $plateforme) {
            $urls[] = array('loc' => $this->get('router')->generate('show_plateforme', array('id' => $plateforme->getId())), 'changefreq' => 'weekly', 'priority' => '0.7');
        }
        foreach ($em->getRepository('CollectibleGamesDatabaseBundle:Jeu')->findAll() as $jeu) {
            $urls[] = array('loc' => $this->get('router')->generate('show_jeu', array('id' => $jeu->getId())), 'changefreq' => 'weekly', 'priority' => '0.8');
        }
        foreach ($em->getRepository('CollectibleGamesDatabaseBundle:Console')->findAll() as $console) {
            $urls[] = array('loc' => $this->get('router')->generate('show_console', array('id' => $console->getId())), 'changefreq' => 'weekly', 'priority' => '0.8');
        }
        foreach ($em->getRepository('CollectibleGamesDatabaseBundle:Accessoire')->findAll() as $accessoire) {
            $urls[] = array('loc' => $this->get('router')->generate('show_accessoire', array('id' => $accessoire->getId())), 'changefreq' => 'weekly', 'priority' => '0.8');
        }
        foreach ($em->getRepository('CollectibleGamesUserBundle:User')->findAll() as $user) {
            $urls[] = array('loc' => $this->get('router')->generate('show_collection', array('id' => $user->getId())), 'changefreq' => 'weekly', 'priority' => '0.8');
        }

        return  $this->render('CollectibleGamesDatabaseBundle:Default:sitemap.xml.twig', array('urls' => $urls, 'hostname' => $hostname), $response);
    }
}