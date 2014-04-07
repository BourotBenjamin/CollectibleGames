<?php
include 'affichage.php';
include 'functions_base_forum.php';
include 'possede_jeu.php';
include 'possede_console.php';
include 'possede_accessoire.php';
include 'album.php';
include 'photo.php';

function ajoutPossessionJeu($id, $jeu)
{
	$possede_jeu = new Possede_Jeu();
	if(isset($_POST['id_possede_jeu']))
	{
		$possede_jeu->setAttr('id_possede_jeu', intval($_POST['id_possede_jeu']));
	}
	$possede_jeu->setAttr('user_id', intval($id));
	$possede_jeu->setAttr('id_jeu', intval($jeu));
	$possede_jeu->setAttr('id_version', Details_Jeu::findIdVersionByString(intval($jeu), strip_tags($_POST['version'])));	
	switch($_POST['etat'])
	{
		case 'Moyen':
			$possede_jeu->setAttr('etat_jeu',1);
			break;
		case 'Bon':
			$possede_jeu->setAttr('etat_jeu',2);
			break;
		case 'Très Bon':
			$possede_jeu->setAttr('etat_jeu',3);
			break;
		case 'Neuf':
			$possede_jeu->setAttr('etat_jeu',4);
			break;
		default:
			$possede_jeu->setAttr('etat_jeu',0);
			break;
	}
	$possede_jeu->setAttr('boite_jeu', intval($_POST['boite']));
	$possede_jeu->setAttr('notice_jeu', intval($_POST['notice']));
	$possede_jeu->setAttr('cartouche_jeu', intval($_POST['cartouche']));
	$possede_jeu->setAttr('cale_jeu', intval($_POST['cale']));
	$possede_jeu->setAttr('blister_souple_jeu', intval($_POST['blister_souple']));
	$possede_jeu->setAttr('blister_rigide_jeu', intval($_POST['blister_rigide']));
	$possede_jeu->setAttr('commentaire_jeu', str_replace("'", "\'", strip_tags($_POST['commentaire'])));
	if($possede_jeu->save()!=0)
	{
		return "<script> $(function(){ alertify.success('Possession ajoutée')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.error('Possession impossible à ajouter')}); </script>";
	}
}

function ajoutPossessionMultiplesJeux($id)
{
	$return = "";
	$v=0;
	$i=0;
	$j=0;
	if (ajoutPossessionJeu($id, $_POST['id_jeu'])=="<script> $(function(){ alertify.success('Possession ajoutée')}); </script>")
	{
		$i++;
	}
	else
	{
		$j++;
	}
	unset($_POST['id_jeu']);	
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{	
			if(Details_Jeu::findIdVersionByString(intval($key), strip_tags($_POST['version']))!=-1)
			{
				if (ajoutPossessionJeu($id, $key)=="<script> $(function(){ alertify.success('Possession ajoutée')}); </script>")
				{
					$i++;
				}
				else
				{
					$j++;
				}
				unset($_POST[$key]);
			}
			else
			{
				$v++;
			}
		}
	}
	if($v==0)
	{
		$_POST['ajoutsPossessionsMultiplesReussies']=1;
	}
	else
	{
		$return = $return."<script> $(function(){ alertify.error('".$v." jeu(x) n\'existe(nt) pas dans la version choisie.')}); </script>";
	}
	if($i>0)
	{
		$return = $return."<script> $(function(){ alertify.success('".$i." possession(s) ajoutée(s)')}); </script>";
	}
	if($j>0)
	{
		$return = $return."<script> $(function(){ alertify.error('".$j." possession(s) impossible(s) à ajouter')}); </script>";
	}
	return $return;
}

function ajoutPossessionAccessoire($id, $accessoire)
{
	$possede_accessoire = new Possede_Accessoire();
	if(isset($_POST['id_possede_accessoire']))
	{
		$possede_accessoire->setAttr('id_possede_accessoire', intval($_POST['id_possede_accessoire']));
	}
	$possede_accessoire->setAttr('user_id', intval($id));
	$possede_accessoire->setAttr('id_accessoire', intval($accessoire));
	$possede_accessoire->setAttr('id_version_accessoire', Version_Accessoire::findIdVersion(intval($accessoire), strip_tags($_POST['region'])));	
	switch($_POST['etat'])
	{
		case 'Moyen':
			$possede_accessoire->setAttr('etat_accessoire',1);
			break;
		case 'Bon':
			$possede_accessoire->setAttr('etat_accessoire',2);
			break;
		case 'Très Bon':
			$possede_accessoire->setAttr('etat_accessoire',3);
			break;
		case 'Neuf':
			$possede_accessoire->setAttr('etat_accessoire',4);
			break;
		default:
			$possede_accessoire->setAttr('etat_accessoire',0);
			break;
	}
	$possede_accessoire->setAttr('boite_accessoire', intval($_POST['boite']));
	$possede_accessoire->setAttr('notice_accessoire', intval($_POST['notice']));
	$possede_accessoire->setAttr('materiel_accessoire', intval($_POST['materiel']));
	$possede_accessoire->setAttr('blister_souple_accessoire', intval($_POST['blister_souple']));
	$possede_accessoire->setAttr('blister_rigide_accessoire', intval($_POST['blister_rigide']));
	$possede_accessoire->setAttr('commentaire_accessoire', str_replace("'", "\'", strip_tags($_POST['commentaire'])));
	if($possede_accessoire->save()!=0)
	{
		return "<script> $(function(){ alertify.success('Possession ajoutée')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.error('Possession impossible à ajouter')}); </script>";
	}
}

function ajoutPossessionMultiplesAccessoires($id)
{
	$return ="";
	$v=0;
	$i=0;
	$j=0;
	if (ajoutPossessionAccessoire($id, $_POST['id_accessoire'])=="<script> $(function(){ alertify.success('Possession ajoutée')}); </script>")
	{
		$i++;
	}
	else
	{
		$j++;
	}
	
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			if(Version_Accessoire::findIdVersion(intval($key), strip_tags($_POST['region']))!=0)
			{
				if (ajoutPossessionAccessoire($id, $key)=="<script> $(function(){ alertify.success('Possession ajoutée')}); </script>")
				{
					$i++;
				}
				else
				{
					$j++;
				}
				unset($_POST[$key]);
			}
			else
			{
				$v++;
			}
		}
	}
	if($v==0)
	{
		$_POST['ajoutsPossessionsMultiplesReussies']=1;
	}
	else
	{
		$return = $return."<script> $(function(){ alertify.error('".$v." accessoire(s) n\'existe(nt) pas dans la version choisie.')}); </script>";
	}
	if($i>0)
	{
		$return = $return."<script> $(function(){ alertify.success('".$i." possession(s) ajoutée(s)')}); </script>";
	}
	if($j>0)
	{
		$return = $return."<script> $(function(){ alertify.error('".$j." possession(s) impossible(s) à ajouter')}); </script>";
	}
	return $return;
}

function ajoutPossessionConsole($id, $console)
{
	$possede_console = new Possede_Console();
	if(isset($_POST['id_possede_console']))
	{
		$possede_console->setAttr('id_possede_console', intval($_POST['id_possede_console']));
	}
	$possede_console->setAttr('user_id', intval($id));
	$possede_console->setAttr('id_console', intval($console));
	$possede_console->setAttr('id_version_console', Version_Console::findIdVersion(intval($console), strip_tags($_POST['region'])));	
	switch($_POST['etat'])
	{
		case 'Moyen':
			$possede_console->setAttr('etat_console',1);
			break;
		case 'Bon':
			$possede_console->setAttr('etat_console',2);
			break;
		case 'Très Bon':
			$possede_console->setAttr('etat_console',3);
			break;
		case 'Neuf':
			$possede_console->setAttr('etat_console',4);
			break;
		default:
			$possede_console->setAttr('etat_console',0);
			break;
	}
	$possede_console->setAttr('boite_console', intval($_POST['boite']));
	$possede_console->setAttr('notice_console', intval($_POST['notice']));
	echo $_POST['machine'];
	$possede_console->setAttr('machine_console', intval($_POST['machine']));
	$possede_console->setAttr('cale_console', intval($_POST['cale']));
	$possede_console->setAttr('console_scelle', intval($_POST['scellee']));
	$possede_console->setAttr('commentaire_console', str_replace("'", "\'", strip_tags($_POST['commentaire'])));
	if($possede_console->save()!=0)
	{
		return "<script> $(function(){ alertify.success('Possession ajoutée')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.error('Possession impossible à ajouter')}); </script>";
	}
}

function ajoutPossessionMultiplesConsoles($id)
{
	$return ="";
	$v=0;
	$i=0;
	$j=0;
	if (ajoutPossessionConsole($id, $_POST['id_console'])=="<script> $(function(){ alertify.success('Possession ajoutée')}); </script>")
	{
		$i++;
	}
	else
	{
		$j++;
	}
	
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			if(Version_Console::findIdVersion(intval($key), strip_tags($_POST['region']))!=0)
			{
				if (ajoutPossessionConsole($id, $key)=="<script> $(function(){ alertify.success('Possession ajoutée')}); </script>")
				{
					$i++;
				}
				else
				{
					$j++;
				}
				unset($_POST[$key]);
			}
			else
			{
				$v++;
			}
		}
	}
	if($v==0)
	{
		$_POST['ajoutsPossessionsMultiplesReussies']=1;
	}
	else
	{
		$return = $return."<script> $(function(){ alertify.error('".$v." console(s) n\'existe(nt) pas dans la version choisie.')}); </script>";
	}
	if($i>0)
	{
		$return = $return."<script> $(function(){ alertify.success('".$i." possession(s) ajoutée(s)')}); </script>";
	}
	if($j>0)
	{
		$return = $return."<script> $(function(){ alertify.error('".$j." possession(s) impossible(s) à ajouter')}); </script>";
	}
	return $return;
}

function ajoutAlbumPhoto()
{
	$album = new Album();
	if(isset($_POST['id_album']))
	{
		$album->setAttr('id_album', intval($_POST['id_album']));
	}
	$album->setAttr('user_id',  intval($_POST['user_id']));
	$album->setAttr('titre_album', str_replace("'", "\'", strip_tags($_POST['titre_album'])));
	$album->setAttr('description_album', str_replace("'", "\'", strip_tags($_POST['description_album'])));
	if($album->save()!=0)
	{
		return "<script> $(function(){ alertify.success('Album ajouté')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.error('Album impossible à ajouter')}); </script>";
	}
}

function modifierPhoto()
{
	$photo = new Photo();
	$photo->setAttr('id_album', intval($_POST['id_album']));
	$photo->setAttr('id_photo', intval($_POST['id_photo']));
	$photo->setAttr('nom_photo', str_replace("'", "\'", strip_tags($_POST['nom_photo'])));
	$photo->setAttr('description_photo', str_replace("'", "\'", strip_tags($_POST['description_photo'])));
	$cover=0;
	if(isset($_POST['albumCover']))
	{
		$album = Album::getById(intval($_POST['id_album']));
		if($album)
		{
			$album->setAttr('couverture_album',intval($_POST['id_photo']));
			$album->save();
			$cover=1;
		}
	}
	if($photo->save()!=0 ||$cover==1)
	{
		return "<script> $(function(){ alertify.success('Photo modifiée')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.error('Photo impossible à modifier')}); </script>";
	}
}

?>