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
					alertify.success("Connexion r�ussie");
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
		<h2>L\'�quipe : </h2>
		<h3>Philoupe - D�veloppeur / Administrateur</h3>
		Actuellement �tudiant � l\'EGSI � Paris, je d�veloppe cet outil sur mon temps libre.<br>
		Originaire des Vosges, j\'ai grandi avec les jeux vid�os et ma passion pour cet art n\'as cess� de grandir<br>
		Mes parents ayant d�j� l\'Amstrad CPC 6128 et la NES avant ma naissance, la SNES n\'as pas tard� � faire son apparition dans notre maison.<br>
		J\'ai commenc� � jouer avec la SNES, la N64, la Megadrive, la Gamecube, la PS1, la PS2, la Wii, la 360 mais aussi sur PC.<br>
		Et enfin, depuis deux ans j\'ai d�cid� de retrouver les jeux de mon pass� mais aussi de d�couvrir ceux que j\'aurais pu manquer<br><br>
		
		<h3>Jerem - Super Contributeur / Mod�rateur global</h3>
		Passionn� de jeux vid�o, plut�t joueur que collectionneur.<br>
		J\'ai une pr�f�rence pour la master system. Mais je poss�de �galement pas mal de consoles comme la ps1, gamecube, n64, snes, nes... <br>
		Niveau collection, j\'ai plusieurs objectif: le full set master system en boite et j\'ai envie de me lancer dans le full set jeux cartouche en loose pour la GB, GBC, GBA, NES, SNES, N64, MD.<br> 
		J\'esp�re pouvoir aider ce site lors de mon temps libre, tout en me laissant le temps de faire mes jaquettes pour k7 video et VHS.<br>
		<div class="cleaner"></div>
		</div> <!-- END of templatemo_main -->';	
print_footer();
?>