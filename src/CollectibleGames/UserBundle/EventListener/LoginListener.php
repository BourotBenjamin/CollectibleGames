<?php

namespace CollectibleGames\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class LoginListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            AuthenticationEvents::AUTHENTICATION_SUCCESS  => 'onLoginSuccess',
        );
    }

    public function onLoginSuccess($event)
    {
		global $user, $auth;
		$u = $event->getAuthenticationToken()->getUser();

		$username = $u->getUsername();
		$password = $u->getPassword();

		if(isset($username) && isset($password))
		{
		  $auth->login($username, $password, true);
		}
    }
}
?>