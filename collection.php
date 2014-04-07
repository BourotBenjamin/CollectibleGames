<?php
if(!isset($_GET['exportCollection']))
{
	$navbar = 2;
	define('IN_PHPBB', true);
	$phpbb_root_path = './forum/';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include($phpbb_root_path . 'common.php');
			 
	// Start session management
	$user->session_begin();
	$auth->acl($user->data);
	$user->setup();
	//$user->data['user_id']
	//$user->data['username']
	//print_header($navbits, $headeralerts, $navbar, $user, 0);

	$headeralerts="";
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
}
include './bddjv/controller.php';
include './collection/controller.php';


if(isset($_POST['validerInformationsPossessionJeu']))
{
 $headeralerts = $headeralerts. ajoutPossessionJeu($user->data['user_id'], $_POST['id_jeu']);
}
if(isset($_POST['validerInformationsPossessionConsole']))
{
 $headeralerts = $headeralerts. ajoutPossessionConsole($user->data['user_id'], $_POST['id_console']);
}
if(isset($_POST['validerInformationsPossessionAccessoire']))
{
 $headeralerts = $headeralerts. ajoutPossessionAccessoire($user->data['user_id'], $_POST['id_accessoire']);
}
if(isset($_POST['validerAjoutAlbumPhoto']))
{
 $headeralerts = $headeralerts.ajoutAlbumPhoto();
}
if(isset($_POST['validerModifierPhoto']))
{
 $headeralerts = $headeralerts.modifierPhoto();
}

if(isset($_GET['action']))
{
	if($_GET['action']=="listMembers")
	{
		$navbits = (array('collection.php?action=listMembers' =>"Liste des membres"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_membres();
	}
	else if($_GET['action']=="editJeu" && isset($_GET['id']))
	{
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username'], '' => "Edition d'un jeu"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		$possessionJeu = Possede_Jeu::findByInfos(intval($_GET['id']));
		$k = $possessionJeu['id_jeu'];
		affiche_modifier_possession_jeu(Jeu::findDetails(intval($k)), Details_Jeu::findAllVersions(intval($k)),$possessionJeu, $user->data['user_id']);
	}
	else if($_GET['action']=="editConsole" && isset($_GET['id']))
	{
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username'], '' => "Edition d'une console"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		$possessionConsole = Possede_Console::findByInfos(intval($_GET['id']));
		$k = $possessionConsole['id_console'];
		affiche_modifier_possession_console(Console::findDetails(intval($k)), Version_Console::findAllVersions(intval($k)),$possessionConsole, $user->data['user_id']);
	}
	else if($_GET['action']=="editAccessoire" && isset($_GET['id']))
	{
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username'], '' => "Edition d'un accessoire"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		$possessionAccessoire = Possede_Accessoire::findByInfos(intval($_GET['id']));
		$k = $possessionAccessoire['id_accessoire'];
		affiche_modifier_possession_accessoire(Accessoire::findDetails(intval($k)), Version_Accessoire::findAllVersions(intval($k)),$possessionAccessoire, $user->data['user_id']);
	}	
	else if($_GET['action']=='supprJeu'  && isset($_GET['id']))
	{
		$possessionJeu = Possede_Jeu::findById(intval($_GET['id']));
		$k = $possessionJeu->getAttr('user_id');
		if($k==$user->data['user_id'])
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.confirm("Êtes vous sûr de vouloir supprimer ce jeu ?", function (e) {
						if (e) {
							self.location.href ="collection.php?action=validationSupprJeu&id='.intval($_GET['id']).'";
						} else {
							alertify.error("Suppression annulée");
						}
					});
				});
			</script>';
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.alert("Le jeu que vous avez essayé de supprimer ne vous appartient pas");
				});
			</script>';
		}
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
	}
	else if($_GET['action']=='validationSupprJeu')
	{
		$possessionJeu = Possede_Jeu::findById(intval($_GET['id']));
		$k = $possessionJeu->getAttr('user_id');
		if($k==$user->data['user_id'])
		{
			if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("collection.php?action=supprJeu&id=".intval($_GET['id'])))=="collection.php?action=supprJeu&id=".intval($_GET['id']))
			{
				$possessionJeu->delete();
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.success("Jeu supprimé");
				});
				</script>';
			}
			else
			{
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.alert("Le jeu que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
				});
				</script>';
			}
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.alert("Le jeu que vous avez essayé de supprimer ne vous appartient pas");
				});
			</script>';
		}
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
	}
	else if($_GET['action']=='supprConsole'  && isset($_GET['id']))
	{
		$possessionConsole = Possede_Console::findById(intval($_GET['id']));
		$k = $possessionConsole->getAttr('user_id');
		if($k==$user->data['user_id'])
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.confirm("Êtes vous sûr de vouloir supprimer cette console ?", function (e) {
					if (e) {
						self.location.href ="collection.php?action=validationSupprConsole&id='.intval($_GET['id']).'";
					} else {
						alertify.error("Suppression annulée");
					}
				});
				});
			</script>';
		}
		else
		{
		$headeralerts = $headeralerts. '<script>
				$(function(){
			alertify.alert("La console que vous avez essayé de supprimer ne vous appartient pas");
				});
		</script>';
		}
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
	}
	else if($_GET['action']=='validationSupprConsole')
	{
		$possessionConsole = Possede_Console::findById(intval($_GET['id']));
		$k = $possessionConsole->getAttr('user_id');
		if($k==$user->data['user_id'])
		{
			if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("collection.php?action=supprConsole&id=".intval($_GET['id'])))=="collection.php?action=supprConsole&id=".intval($_GET['id']))
			{
				$possessionConsole->delete();
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.success("Console supprimé");
				});
				</script>';
			}
			else
			{
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.alert("La console que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
				});
				</script>';
			}
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
				alertify.alert("La console que vous avez essayé de supprimer ne vous appartient pas");
				});
			</script>';
		}
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
	}
	else if($_GET['action']=='supprAccessoire'  && isset($_GET['id']))
	{
		$possessionAccessoire = Possede_Accessoire::findById(intval($_GET['id']));
		$k = $possessionAccessoire->getAttr('user_id');
		if($k==$user->data['user_id'])
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.confirm("Êtes vous sûr de vouloir supprimer cet accessoire ?", function (e) {
					if (e) {
						self.location.href ="collection.php?action=validationSupprAccessoire&id='.intval($_GET['id']).'";
					} else {
						alertify.error("Suppression annulée");
					}
				});
				});
			</script>';
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
					$(function(){
				alertify.alert("L\'accessoire que vous avez essayé de supprimer ne vous appartient pas");
					});
			</script>';
		}
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
	}
	else if($_GET['action']=='validationSupprAccessoire')
	{
		$possessionAccessoire = Possede_Accessoire::findById(intval($_GET['id']));
		$k = $possessionAccessoire->getAttr('user_id');
		if($k==$user->data['user_id'])
		{
			if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("collection.php?action=supprAccessoire&id=".intval($_GET['id'])))=="collection.php?action=supprAccessoire&id=".intval($_GET['id']))
			{
				$possessionAccessoire->delete();
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.success("Accessoire supprimé");
				});
				</script>';
			}
			else
			{
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.alert("L\'accessoire que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
				});
				</script>';
			}
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.alert("L\'accessoire que vous avez essayé de supprimer ne vous appartient pas");
				});
			</script>';
		}
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])),  true,$user->data['username'], $user->data['user_id']);
	}
	else if($_GET['action']=="createAlbum")
	{
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username'], 'collection.php?action=createAlbum' =>"Creéer un album photos"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_ajout_album_photo($user->data['user_id']);
	}
	else if($_GET['action']=='supprPhoto'  && isset($_GET['id']))
	{
		$k = -1;
		$a = array();
		$a['photos']=array();
		$photo = Photo::findById(intval($_GET['id']));
		if($photo->getAttr('id_album')!=null)
		{
			$album = $photo->getAttr('id_album');
			$a = Album::findById($album);
			if($a!=null)
			{
				$k = $a['user_id'];
			}
			if($k==$user->data['user_id'])
			{
				$headeralerts = $headeralerts. '<script>
					$(function(){
					alertify.confirm("Êtes vous sûr de vouloir supprimer cette photo ?", function (e) {
						if (e) {
							self.location.href ="collection.php?action=validationSupprPhoto&id='.intval($_GET['id']).'";
						} else {
							alertify.error("Suppression annulée");
						}
					});
					});
				</script>';
			}
			else
			{
				$headeralerts = $headeralerts. '<script>
				$(function(){
					alertify.alert("La photo que vous avez essayé de supprimer ne vous appartient pas");
				});
				</script>';
			}
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.alert("La photo n\'existe pas");
				});
			</script>';
		}
		//$navbits = (array('collection.php?action=createAlbum' =>"Voir un album photo"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_album_photo($a, $user->data['user_id']);
	}
	else if($_GET['action']=='validationSupprPhoto'   && isset($_GET['id']))
	{
		$k = -1;
		$a = array();
		$photo = Photo::findById(intval($_GET['id']));
		if($photo->getAttr('id_album')!=null)
		{
			$album = $photo->getAttr('id_album');
			$a = Album::findById($album);
			if($a!=null)
			{
				$k = $a['user_id'];
			}
			if($k==$user->data['user_id'])
			{
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("collection.php?action=supprPhoto&id=".intval($_GET['id'])))=="collection.php?action=supprPhoto&id=".intval($_GET['id']))
				{
					$photo->delete();
					$headeralerts = $headeralerts. '<script>
					$(function(){
						alertify.success("Photo supprimée");
					});
					</script>';
				}
				else
				{
					$headeralerts = $headeralerts. '<script>
					$(function(){
						alertify.alert("La photo que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
					});
					</script>';
				}
			}
			else
			{
				$headeralerts = $headeralerts. '<script>
					$(function(){
					alertify.alert("La photo que vous avez essayé de supprimer ne vous appartient pas");
					});
				</script>';
			}
		}
		else
		{
			$headeralerts = $headeralerts. '<script>
				$(function(){
				alertify.alert("La photo n\'existe pas");
				});
			</script>';
		}
		//$navbits = (array('collection.php?action=createAlbum' =>"Voir un album photo"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_album_photo(Album::findById($album), $user->data['user_id']);
	}
	else if($_GET['action']=='editPhoto'   && isset($_GET['id']))
	{
		$k = -1;
		$a = array();
		$photo = Photo::findById(intval($_GET['id']));
		if($photo->getAttr('id_album')!=null)
		{
			$album = $photo->getAttr('id_album');
			$a = Album::findById($album);
			if($a!=null)
			{
				$k = $a['user_id'];
			}
		}
		//$navbits = (array('collection.php?action=createAlbum' =>"Voir un album photo"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_modifier_photo($photo, $k==$user->data['user_id']);
	}
	else
	{
		$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
	}
}
else if(isset($_GET['viewCollection']))
{
	$navbits = (array('collection.php?viewCollection='.$_GET['viewCollection'] =>"Affichage de la collection de ".findUsername(intval($_GET['viewCollection']))));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	affiche_collection(Possede_Jeu::findAllByUser(intval($_GET['viewCollection'])), Possede_Console::findAllByUser(intval($_GET['viewCollection'])), Possede_Accessoire::findAllByUser(intval($_GET['viewCollection'])), Album::findAllByUser(intval($_GET['viewCollection'])), $user->data['user_id']==intval($_GET['viewCollection']), findUsername(intval($_GET['viewCollection'])), $_GET['viewCollection']);
}
else if(isset($_GET['exportCollection']))
{
	if(isset($_GET['mode']) && $_GET['mode']=='csv')
	{
		export_collection_csv(Possede_Jeu::findAllByUser(intval($_GET['exportCollection'])), Possede_Console::findAllByUser(intval($_GET['exportCollection'])), Possede_Accessoire::findAllByUser(intval($_GET['exportCollection'])), findUsername(intval($_GET['exportCollection'])));
	}
	else
	{
		export_collection(Possede_Jeu::findAllByUser(intval($_GET['exportCollection'])), Possede_Console::findAllByUser(intval($_GET['exportCollection'])), Possede_Accessoire::findAllByUser(intval($_GET['exportCollection'])), findUsername(intval($_GET['exportCollection'])));
	}
}
else if(isset($_GET['viewAlbum']))
{
	//$navbits = (array('collection.php?action=viewAlbum' =>"Voir un album photo"));
	// TODO - collection de ... - album ...
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	affiche_album_photo(Album::findById(intval($_GET['viewAlbum'])), $user->data['user_id']);
}
else if(isset($_GET['editAlbum']))
{
	$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username'], 'collection.php?action=editAlbum&id='.$_GET['editAlbum'] =>"Modifier un album photo"));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	affiche_modifier_album_photo(Album::findById(intval($_GET['editAlbum'])), $user->data['user_id']);
}
else
{
	$navbits = (array('collection.php?viewCollection='.$user->data['user_id'] =>"Affichage de la collection de ".$user->data['username']));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	affiche_collection(Possede_Jeu::findAllByUser(intval($user->data['user_id'])), Possede_Console::findAllByUser(intval($user->data['user_id'])), Possede_Accessoire::findAllByUser(intval($user->data['user_id'])), Album::findAllByUser(intval($user->data['user_id'])), true,$user->data['username'], $user->data['user_id']);
}

if(!isset($_GET['exportCollection']))
{
	print_footer();
}
?> 