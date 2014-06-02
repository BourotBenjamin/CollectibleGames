<?php

ini_set( 'memory_limit', '1024M' );

use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';


require_once __DIR__.'/../app/AppKernel.php';
		global $db,$cache,$phpEx,$config,$phpbb_root_path, $user, $auth;
		$phpbb_root_path = __DIR__.'/../forum/';
		define ('IN_PHPBB', true);
		$phpEx = "php";
		require_once ($phpbb_root_path.'config.php');
		include($phpbb_root_path . 'common.' . $phpEx);
		// Start session management
		$user->session_begin();
		$auth->acl($user->data);
		$user->setup();
$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
