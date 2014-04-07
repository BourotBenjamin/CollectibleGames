<?php

 
define('IN_PHPBB', true);
$phpbb_root_path = './forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.php');
         
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
//$user->data['userid']
//$user->data['username']
//print_header($navbits, $headeralerts, $navbar, $pagetitle);

if(isset($_POST['logout']))
{
		$user->session_kill();
		$user->session_begin();
		$headeralerts = '<script>
				$(function(){
					alertify.success("Au revoir");
				});
			</script>';
}
if(isset($_POST['login']))
{
	$result = $auth->login($_POST['username'], $_POST['password']);
	if ($result['status'] == LOGIN_SUCCESS)
	{
		$headeralerts = '<script>
				$(function(){
					alertify.success("Connexion réussie");
				});
			</script>';
	}
	else
	{
		$headeralerts = '<script>
				$(function(){
					alertify.error("Erreur lors de la connexion");
				});
			</script>';
	}
}

include 'bddjv/affichage.php';
print_header(null, $headeralerts, null, $user, 1);

		echo '<div id="templatemo_main">
		<h2>L\'équipe : </h2>
		<h3>Philoupe - Développeur / Administrateur</h3>
		Actuellement étudiant à l\'EGSI à Paris, je développe cet outil sur mon temps libre.<br>
		Originaire des Vosges, j\'ai grandi avec les jeux vidéos et ma passion pour cet art n\'as cessé de grandir<br>
		Mes parents ayant déjà l\'Amstrad CPC 6128 et la NES avant ma naissance, la SNES n\'as pas tardé à faire son apparition dans notre maison.<br>
		J\'ai commencé à jouer avec la SNES, la N64, la Megadrive, la Gamecube, la PS1, la PS2, la Wii, la 360 mais aussi sur PC.<br>
		Et enfin, depuis deux ans j\'ai décidé de retrouver les jeux de mon passé mais aussi de découvrir ceux que j\'aurais pu manquer<br><br>
		
		<h3>Jerem - Super Contributeur / Modérateur global</h3>
		Passionné de jeux vidéo, plutôt joueur que collectionneur.<br>
		J\'ai une préférence pour la master system. Mais je possède également pas mal de consoles comme la ps1, gamecube, n64, snes, nes... <br>
		Niveau collection, j\'ai plusieurs objectif: le full set master system en boite et j\'ai envie de me lancer dans le full set jeux cartouche en loose pour la GB, GBC, GBA, NES, SNES, N64, MD.<br> 
		J\'espère pouvoir aider ce site lors de mon temps libre, tout en me laissant le temps de faire mes jaquettes pour k7 video et VHS.<br>
		<div class="cleaner"></div>
		</div> <!-- END of templatemo_main -->';	
print_footer();
?>