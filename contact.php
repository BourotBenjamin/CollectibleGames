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

include 'bddjv/controller.php';
if(isset($_POST["validerAjoutBug"]))
{
	$headeralerts = $headeralerts.ajoutBug();
}
print_header(null, $headeralerts, null, $user, 1);

		echo '<div id="templatemo_main">
		<h2>Contact</h2>
		<form action="" method=POST>
		<TEXTAREA NAME="description_bug" ROWS=3 COLS=100 ></TEXTAREA><br>
		<input type=hidden name="type_bug" value=3 /><br>
		<input type=submit name="validerAjoutBug" value="Valider" />
		</form>
		<div class="cleaner"></div><br>
		<h2>FAQ</h2>
		<h3>Collectible Games ? C\'est quoi ?</h3>
		Collectible Games est un site regroupant un ensemble de modules vous permettant de g�rer votre passion.<br>
		Les modules actuellement disponibles sont :<br>
		La base de donn�e des jeux vid�os : Elle essaye de regrouper tout les jeux / consoles et accessoires existant dans toutes les variations possibles.
		Les gestionnaire de collection : Il vous permet de g�rer votre collection avec plus de pr�cision que les syst�mes actuels vous proposant ainsi jeux, consoles, accessoires mais il vous permet de choisir par exemple chacune des versions de votre objet.<br>
		
		<h3> Et tout �a, comment �a fonctionne ? </h3>
		<h4>La base de donn�e</h4>
		<img src="images/FAQ/bddjv_01.png" /><br>
		Voici comment se pr�sente la base de donn�e du site.<br>
		Pour votre informations, certaines fonctionnalit�s, comme la gestion de votre collection ne sont disponibles que si vous �tes connect�s.<br>
		Les comptes utilis�s par le site sont les m�mes que ceux utilis�s pour le forum. Vous n\'avez donc pas � vous cr�er deux comptes.<br>
		Le formulaire d\'inscription (Lien encadr� en rouge) et celui de connexion (encadr� en orange) sont disponibles su toutes les pages si vous n\'�tes pas connect�.<br>
		Vous pouvez effectuer une recherche dans la base de donn�e, le lien encadr� en bleu vous enverra vers le moteur de recherche du site.<br>
		Ou alors, vous pouvez d�cider de naviguer dans la base de donn�e en cliquant sur une marque disponible.<br>
		<br><br><img src="images/FAQ/bddjv_02.png" /><br>
		Le moteur de recherche vous permet de rechercher une information par nom dans la base de donn�e.<br>
		<br><br><img src="images/FAQ/bddjv_02b.png" /><br>
		Si vous naviguez vous arriverez � la page consacr� � la marque.<br>
		Vous trouverez en haut de la page le logo ainsi que la description de la marque.<br>
		Il se peut que cette partie sois blanche si la marque � �t� ajout�e r�cemment.<br>
		En dessous, vous verrez les logos des diff�rentes plateformes de la marque.<br>
		En passant la souris dessus, vous verrez le lien (encadr� vert) apparaitre.<br>
		En cliquant sur le logo, vous acc�derez alors � la page d�di�e � la console avec une liste des jeux / accessoires / consoles<br>
		En cliquant sur le lien, vous acc�derez alors � la page d�di�e � la console avec une liste d�taill� des jeux / accessoires / consoles avec des filtres et d\'autres options de tri<br>
		La page avec les liste d�taill�es peut �tre longue � charger car votre navigateur va devoir mettre en forme un grand nombre de donn�es.<br>
		<br><br><img src="images/FAQ/bddjv_03.png" /><br>
		Sur la page d�diez � une plateforme, vous retrouverez, en haut, sa description<br>
		Puis en dessous, vous trouverez des liens pour afficher les packs / jeux / accessoires de cette console<br>
		<br><br><img src="images/FAQ/bddjv_04.png" /><br>
		En cliquant sur un des liens, un tableau va appara�tre juste en dessous<br>
		La page "de base"  (vous y acc�dez en cliquant sur le logo) ne contient que les noms de jeux / accessoires / consoles (premi�re colone de l\'image).<br>
		Elle ne contient pas les filtres que vous voyez sur l\'image (contrairement � la page d�taill�e).<br>
		Alors que le tableau que vous voyez est le tableau d�taill� (vous y acc�dez en cliquant sur le lien).<br>
		C\'est aussi ce tableau que vous trouverez si vous faites une recherche par nom. <br>
		Comme vous pouvez le voir, le tableau contient beaucoup d\'informations et certaines recherches sont possibles.<br>
		Tout d\'abord vous trouvez les filtres (encadr�s en mauve).<br>
		Vous pouvez cliquer dessus pour n\'afficher que les jeux correspondants.<br>
		Toutefois, m�me si vous pouvez activer plusieurs filtres � la fois, c\'est un "ET" qui est appliqu� entre les filtres.<br>
		Donc si vous cliquez par exemple dans r�gion sur "Europe" et "Br�sil", le site va uniquement afficher les jeux vendus en Europe et au Br�sil.<br>
		Pour activer des filtres, vous pouvez aussi activer des filtres en cliquant directement sur le tableau des jeux (encadr� en jaune).
		Vous pouvez aussi rechercher un jeu avec un nombre de joueur minimum (encadr� en rouge).<br>
		Si vous souhaitez effectuer une recherche personnalis�e, un champ de recherche est disponible en haut � gauche du tableau (encadr� en orange). Il recherche dans toutes les colones du tableau.
		Et vous pouvez �galement chang� le nombre d\'�l�ment visible sur une page (encadr� bleu).<br>
		Pour avoir plus d\'informations sur un jeu, vous n\'avez qu\'� sur le titre de ce dernier pour acc�der � sa fiche (encadr� brun). <br>		
		<br><br><img src="images/FAQ/bddjv_05.png" /><br>
		Quand vous avez s�lectionn� un filtre vous pouvez le d�s�lectionner de trios mani�res diff�rentes (encadr�s verts): <br>
		En cliquant dessus dans le tableau des filtres.<br>
		En cliquant dessus dans la liste des filtre actifs.<br>
		En cliquant dessus dans le tableau de jeux.<br>
		En bas de la page vous trouverez les boutons pour changer la page du tableau. (encadr� rouge)<br>
		Si vous avez envie de nous aider et que vous ne trouvez pas les informations que vous souhaitez, vous pouvez ajouter un jeu dans notre base de donn�e en cliquant sur le lien encadr� en bleu.<br>
		Les liens sont �galement disponibles en fond de chaque pages.<br>
		<br><br><img src="images/FAQ/bddjv_06.png" /><br>
		Si vous �tes connect�s, vous pourrez �galement g�rer votre collection gr�ce � ce tableau.<br>
		Vous pourrez ajouter un ou plusieurs jeux en s�lectionnant les cases (entour�es en rouge) � cocher puis en cliquant sur le bouton en dessous.(entour� en orange)<br> 	
		Seuls les jeux affich�s seront ajout�s, mais si vous effectuez une recherche, les cases ne seront pas d�coch�es.<br>
		Mon conseil : Cherchez les jeux que vous voulez ajouter gr�ce aux outils, mais d�sactivez les filtres, et affichez tout les jeux sur la page quand vous souhaitez ajouter des jeux.<br>
		<br><br><img src="images/FAQ/bddjv_07.png" /><br>
		Sur une fiche de jeu, vous trouverez les informations dur consacr� au jeu (encadr� en mauve), puis les diff�rentes versions.<br>
		Pour afficher les versions du jeu, vous n\'avez qu\'� cliquer sur afficher.<br>
		Si vous voyez qu\'une information est erron�e, vous pouvez �diter le jeu<br>
		Et si une information est manquante, vous pouvez l\'ajouter.<br>
		<br><br><img src="images/FAQ/bddjv_08.png" /><br>
		Sur une version, vous y trouverez toutes les informations � gauche (encadr� vert) et les photos � droite(encadr� bleu).<br>
		En cliquant sur une image, vous pourrez la voir en taille r��le, comme dans l\'exemple.<br>
		Pour refermer l\'image, il vous suffit de cliquer dessus.<br>
		<br><br><img src="images/FAQ/bddjv_09.png" /><br>
		Pour ajouter des informations, c\'est un simple formulaire. Il contient seulement deux sp�cificit�s :<br>
		Les "+" (encadr�s en vert) vous permettent d\'ajouter plusieurs informations d\'un m�me type. Pour rappel : 1 case = 1 information uniquement.<br>
		Le lien entour� en bleu vous permet d\'ajouter une version � ce que vous ajoutez ou modifiez.<br>
		<br><h4>La gestion de collection</h4>
		<br><img src="images/FAQ/collection_02.png" /><br>
		Quand vous ajoutez une informations dans votre collections vous indiquez : <br>
		- L\'�tat de l\'objet<br>
		- Sa version<br>
		- Ce que vous avez avec<br>
		- Et vous pouvez ajouter un commentaire par rapport � cet objet.<br>
		Vous pouvez ensuite valider, mais si les informations que vous avez rentr�s sont identiques pour tout les autres objets que vous voulez ajouter, alors le bouton encadr� en bleu vous le permet.<br>
		Si un jeu n\'existe pas dans la version demand�e, alors, ce informations vous seront demand�s pour ce jeu. (Comme ici).<br>
		<br><br><img src="images/FAQ/collection_01.png" /><br>
		Enfin, voici l\'affichage de votre collection.<br>
		Ici vous verrez tout vos jeux dans la version et dans le niveau de compl�tion ( boite / jeu / notice ) que vous l\'avez.<br>
		Dans cette exemple, on peux voir que j\'ai mario 64 en boite, mario 64 en loose et la notice de mario 64 seule.<br>
		Si vous passez sur l\'image d\'une possession, vous pourrez alors voir cette GBA (encadr� vert) appara�tre avec les informations :<br>
		- Le titre<br>
		- Le niveau de compl�tion (Logo tr�s clair = absent / Logo fonc� = pr�sent)<br>
		(Vous pouvez passer votre souris sur le logo si vous ne savez pas � quoi il correspond, comme sur la plupart des images du site).<br>
		- L\'�tat<br>
		- Le commentaire (si vous en avez mis un)<br>
		Vous pourrez aussi trouver, si c\'est votre collection que vous �tre en train de visionner) les boutons "Edit" et "Suppr" qui vont vous permettre de modifier votre collection.<br>
		Enfin, vous pouvez exporter votre collection en fichier texte avec le lien en bas de page (encadr� mauve).
		<br><br><br>
		<h3> Mais ? Tout ces points d\'interrogations, c\'est quoi ? </h3>
		Ce sont les images manquantes dans notre base de donn�e. Nous sommes en train de compl�ter les informations, mais si vous souhaitez nous aider, allez y.
		
		</div> <!-- END of templatemo_main -->';
		
		
print_footer();
?>