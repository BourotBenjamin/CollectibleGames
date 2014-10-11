<?php

namespace CollectibleGames\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CollectibleGames\ForumBundle\Entity\Message;
use CollectibleGames\ForumBundle\Entity\Topic;

class DefaultController extends Controller
{
    /**
     * @Route("/forum", name="forum_index")
     * @Template()
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository("CollectibleGamesForumBundle:Categorie")->findBy(array(), array("place"=> "ASC"));
        return array('categories' => $categories);
    }
	
    /**
     * @Route("/forum/cat/{id}", name="show_forum")
     * @Template()
     */
    public function forumAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$forum = $em->getRepository("CollectibleGamesForumBundle:Forum")->find($id);
		$topics = $em->getRepository("CollectibleGamesForumBundle:Topic")->findBy(array('forum'=>$forum), array('repliedAt'=>'DESC'));
        return array('forum' => $forum,'topics' => $topics);
    }
	
    /**
     * @Route("/forum/topic/{id}", name="show_topic")
     * @Template()
     */
    public function topicAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$topic = $em->getRepository("CollectibleGamesForumBundle:Topic")->find($id);
		if($this->getRequest()->getMethod() == 'POST')
		{
			$user = $this->container->get('security.context')->getToken()->getUser();
			if(is_object($user))
			{
				$message = new Message();
				$message->setCreatedBy($user);
				$message->setCreatedAt(new \DateTime("now"));
				$topic->setRepliedAt(new \DateTime("now"));
				$message->setTopic($topic);
				$message->setText($this->getRequest()->request->get('message'));
				$em->persist($message);
				$topic->addMessages($message);
				$em->persist($topic);
				$forum = $topic->getForum();
				$forum->setLastMessage($message);
				$em->persist($forum);
				$em->flush();
			}
		}
        return array('topic' => $topic);
    }
	
    /**
     * @Route("/forum/new-topic/{id}", name="new_topic")
     * @Template()
     */
    public function createTopicAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$forum = $em->getRepository("CollectibleGamesForumBundle:Forum")->find($id);
		if($this->getRequest()->getMethod() == 'POST')
		{
			$user = $this->container->get('security.context')->getToken()->getUser();
			if(is_object($user))
			{
				$req = $this->getRequest()->request;
				$topic = new Topic();
				$topic->setCreatedBy($user);
				$topic->setName($req->get('title'));
				$topic->setDescription($req->get('description'));
				$topic->setType(0);
				$topic->setLocked(0);
				$topic->setForum($forum);
				$topic->setRepliedAt(new \DateTime("now"));
				$topic->setCreatedAt(new \DateTime("now"));
				$message = new Message();
				$message->setCreatedBy($user);
				$message->setCreatedAt(new \DateTime("now"));
				$message->setTopic($topic);
				$message->setText($req->get('message'));
				$em->persist($message);
				$topic->addMessages($message);
				$em->persist($topic);
				$forum->setLastMessage($message);
				$em->persist($forum);
				$em->flush();
				return $this->redirect($this->generateUrl('show_topic', array('id'=>$topic->getId())));
			}
		}
        return array();
    }
    /**
     * @Route("/forum/edit-topic/{id}", name="edit_topic")
     * @Template()
     */
    public function editTopicAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$topic = $em->getRepository("CollectibleGamesForumBundle:Topic")->find($id);
		$message = $em->getRepository("CollectibleGamesForumBundle:Message")->findByTopic($id)[0];
		$user = $this->container->get('security.context')->getToken()->getUser();
		if($user == $topic->getCreatedBy())
		{
			if($this->getRequest()->getMethod() == 'POST')
			{
				if(is_object($user))
				{
					$req = $this->getRequest()->request;
					$topic->setName($req->get('title'));
					$topic->setDescription($req->get('description'));
					$message->setText($req->get('message'));
					$em->persist($message);
					$em->persist($topic);
					$em->flush();
					return $this->redirect($this->generateUrl('show_topic', array('id'=>$id)));
				}
			}
			return array('topic'=>$topic, 'message'=>$message);
		}
		else
		{
			$fuck->you();
		}
    }
	
    /**
     * @Route("/forum/edit-message/{id}", name="edit_message")
     * @Template()
     */
    public function editMessageAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$message = $em->getRepository("CollectibleGamesForumBundle:Message")->find($id);
		$user = $this->container->get('security.context')->getToken()->getUser();
		if($user == $message->getCreatedBy())
		{
			if($this->getRequest()->getMethod() == 'POST')
			{
				if(is_object($user))
				{
					$req = $this->getRequest()->request;
					$message->setText($req->get('message'));
					$em->persist($message);
					$em->flush();
					return $this->redirect($this->generateUrl('show_topic', array('id'=>$message->getTopic()->getId())));
				}
			}
			return array('message'=>$message);
		}
		else
		{
			$fuck->you();
		}
    }
	
	
}
