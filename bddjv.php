 <?php
 
$navbar = 1;
define('IN_PHPBB', true);
$phpbb_root_path = './forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.php');
         
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();


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

include './bddjv/controller.php';
include './collection/controller.php';


if(isset($_POST['admRemplaceCommandes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceCommandes();
}
if(isset($_POST['admSuppressionCommandes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionCommandes();
}
if(isset($_POST['admValidationCommandes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationCommandes();
}
if(isset($_POST['admRemplaceDeveloppeurs']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceDeveloppeurs();
}
if(isset($_POST['admSuppressionDeveloppeurs']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionDeveloppeurs();
}
if(isset($_POST['admValidationDeveloppeurs']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationDeveloppeurs();
}
if(isset($_POST['admRemplaceEditeurs']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceEditeurs();
}
if(isset($_POST['admSuppressionEditeurs']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionEditeurs();
}
if(isset($_POST['admValidationEditeurs']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationEditeurs();
}
if(isset($_POST['admRemplaceEditions']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceEditions();
}
if(isset($_POST['admSuppressionEditions']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionEditions();
}
if(isset($_POST['admValidationEditions']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationEditions();
}
if(isset($_POST['admRemplaceFormats']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceFormats();
}
if(isset($_POST['admSuppressionFormats']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionFormats();
}
if(isset($_POST['admValidationFormats']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationFormats();
}
if(isset($_POST['admRemplaceGroupes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceGroupes();
}
if(isset($_POST['admSuppressionGroupes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionGroupes();
}
if(isset($_POST['admValidationGroupes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationGroupes();
}
if(isset($_POST['admRemplaceLangues']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceLangues();
}
if(isset($_POST['admSuppressionLangues']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionLangues();
}
if(isset($_POST['admValidationLangues']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationLangues();
}
if(isset($_POST['admRemplacePlateformes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplacePlateformes();
}
if(isset($_POST['admSuppressionPlateformes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionPlateformes();
}
if(isset($_POST['admValidationPlateformes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationPlateformes();
}
if(isset($_POST['admRemplaceRegions']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceRegions();
}
if(isset($_POST['admSuppressionRegions']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionRegions();
}
if(isset($_POST['admValidationRegions']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationRegions();
}
if(isset($_POST['admRemplaceSupports']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceSupports();
}
if(isset($_POST['admSuppressionSupports']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionSupports();
}
if(isset($_POST['admValidationSupports']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationSupports();
}
if(isset($_POST['admRemplaceTypes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceTypes();
}
if(isset($_POST['admSuppressionTypes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionTypes();
}
if(isset($_POST['admValidationTypes']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationTypes();
}
if(isset($_POST['admRemplaceTypesAccessoires']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. remplaceTypesAccessoires();
}
if(isset($_POST['admSuppressionTypesAccessoires']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. suppressionTypesAccessoires();
}
if(isset($_POST['admValidationTypesAccessoires']) && (in_array($user->data['group_id'], Base::getModos())))
{
 $headeralerts = $headeralerts. validationTypesAccessoires();
}
if(isset($_POST['validerRechercheModifDeveloppeur']))
{
	$developpeurs=Developpeur::findByName(strip_tags($_POST['nom_developpeur']));
	if(isset($developpeurs[0]))
	{
		$developpeur=$developpeurs[0]->getAttr('id_developpeur');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le développeur recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifLangue']))
{
	$langues=Langue::findByName(strip_tags($_POST['nom_langue']));
	if(isset($langues[0]))
	{
		$langue=$langues[0]->getAttr('id_langue');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("La langue recherchée n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifFormat']))
{
	$formats=Format::findByName(strip_tags($_POST['nom_format']));
	if(isset($formats[0]))
	{
		$format=$formats[0]->getAttr('id_format');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le format recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifSupport']))
{
	$supports=Support::findByName(strip_tags($_POST['nom_support']));
	if(isset($supports[0]))
	{
		$support=$supports[0]->getAttr('id_support');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le support recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifEditeur']))
{
	$editeurs=Editeur::findByName(strip_tags($_POST['nom_editeur']));
	if(isset($editeurs[0]))
	{
		$editeur=$editeurs[0]->getAttr('id_editeur');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("L\'editeur recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifEdition']))
{
	$editions=Edition::findByName(strip_tags($_POST['nom_edition']));
	if(isset($editions[0]))
	{
		$edition=$editions[0]->getAttr('id_edition');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("L\'edition recherchée n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifPlateforme']))
{
	$plateformes=Plateforme::findByName(strip_tags($_POST['nom_plateforme']));
	if(isset($plateformes[0]))
	{
		$plateforme=$plateformes[0]->getAttr('id_plateforme');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("La plateforme recherchée n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifRegion']))
{
	$regions=Region::findByName(strip_tags($_POST['nom_region']));
	if(isset($regions[0]))
	{
		$region=$regions[0]->getAttr('id_region');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("La region recherchée n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifTypeJeu']))
{
	$types=Type_Jeu::findByName(strip_tags($_POST['nom_type_jeu']));
	if(isset($types[0]))
	{
		$type=$types[0]->getAttr('id_type_jeu');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le type recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifTypeAccessoire']))
{
	$types=Type_Accessoire::findByName(strip_tags($_POST['nom_type_accessoire']));
	if(isset($types[0]))
	{
		$typeAccessoire=$types[0]->getAttr('id_type_accessoire');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le type recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifGroupe']))
{
	$groupes=Groupe::findByName(strip_tags($_POST['groupe']));
	if(isset($groupes[0]))
	{
		$groupe=$groupes[0]->getAttr('id_groupe');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le groupe recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifCommande']))
{
	$commandes=Commande::findByName(strip_tags($_POST['nom_commande']));
	if(isset($commandes[0]))
	{
		$commande=$commandes[0]->getAttr('id_commande');
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le contrôleur recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerRechercheModifJeu']))
{
	$jeux = Jeu::findByKeys(strip_tags($_POST['nom_jeu']),strip_tags($_POST['nom_plateforme_jeu']));
	if(isset($jeux[0]))
	{
		$jeu=$jeux[0];
	}
	else
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Le jeu recherché n\'éxiste pas.");</script>');
	}
}
if(isset($_POST['validerAjoutDeveloppeur']))
{
 $headeralerts = $headeralerts. ajoutDeveloppeur();
}
if(isset($_POST['validerAjoutLangue']))
{
 $headeralerts = $headeralerts. ajoutLangue();
}
if(isset($_POST['validerAjoutMultiLangue']))
{
 $headeralerts = $headeralerts. ajoutMultiLangue();
}
if(isset($_POST['validerAjoutFormat']))
{
 $headeralerts = $headeralerts. ajoutFormat();
}
if(isset($_POST['validerAjoutMultiFormat']))
{
 $headeralerts = $headeralerts. ajoutMultiFormat();
}
if(isset($_POST['validerAjoutSupport']))
{
 $headeralerts = $headeralerts. ajoutSupport();
}
if(isset($_POST['validerAjoutMultiSupport']))
{
 $headeralerts = $headeralerts. ajoutMultiSupport();
}
if(isset($_POST['validerAjoutEditeur']))
{
 $headeralerts = $headeralerts. ajoutEditeur();
}
if(isset($_POST['validerAjoutMultiEditeur']))
{
 $headeralerts = $headeralerts. ajoutMultiEditeur();
}
if(isset($_POST['validerAjoutEdition']))
{
 $headeralerts = $headeralerts. ajoutEdition();
}
if(isset($_POST['validerAjoutMultiEdition']))
{
 $headeralerts = $headeralerts. ajoutMultiEdition();
}
if(isset($_POST['validerAjoutNomJeu']))
{
 $headeralerts = $headeralerts. ajoutNomJeu();
}
if(isset($_POST['validerAjoutPlateforme']))
{
 $headeralerts = $headeralerts. ajoutPlateforme();
}
if(isset($_POST['validerAjoutMultiPlateforme']))
{
 $headeralerts = $headeralerts. ajoutMultiPlateforme();
}
if(isset($_POST['validerAjoutRegion']))
{
 $headeralerts = $headeralerts. ajoutRegion();
}
if(isset($_POST['validerAjoutMultiRegion']))
{
 $headeralerts = $headeralerts. ajoutMultiRegion();
}
if(isset($_POST['validerAjoutTypeJeu']))
{
 $headeralerts = $headeralerts. ajoutTypeJeu();
}
if(isset($_POST['validerAjoutAccessoire']))
{
 $headeralerts = $headeralerts. ajoutAccessoire($user);
}
if(isset($_POST['validerAjoutVersionAccessoire']))
{
 $headeralerts = $headeralerts. ajoutVersionAccessoire($user);
}
if(isset($_POST['validerAjoutConsole']))
{
 $headeralerts = $headeralerts. ajoutConsole($user);
}
if(isset($_POST['validerAjoutVersionConsole']))
{
 $headeralerts = $headeralerts. ajoutVersionConsole($user);
}
if(isset($_POST['validerAjoutTypeAccessoire']))
{
 $headeralerts = $headeralerts. ajoutTypeAccessoire();
}
if(isset($_POST['validerModifJeu']))
{
 $headeralerts = $headeralerts. modifJeu($user);
}
if(isset($_POST['validerAjoutJeu']))
{
 $headeralerts = $headeralerts. ajoutJeu($user);
}
if(isset($_POST['validerAjoutVersionJeu']))
{
 $headeralerts = $headeralerts. ajoutVersionJeu($user);
}
if(isset($_POST['validerAjoutGroupe']))
{
 $headeralerts = $headeralerts. ajoutGroupe();
}
if(isset($_POST['validerAjoutMultiCommande']))
{
 $headeralerts = $headeralerts. ajoutMultiCommande();
}
if(isset($_POST['validerAjoutCommande']))
{
 $headeralerts = $headeralerts. ajoutCommande();
}
if(isset($_POST['validerAjoutDescriptionEditeur']))
{
 $headeralerts = $headeralerts. ajoutDescriptionEditeur();
}
if(isset($_POST['validerReportInformationErronee']))
{
 $headeralerts = $headeralerts. ajoutReportInformationErronee();
}
if(isset($_POST['validerInformationsPossessionJeu']) && $user->data['user_id']!=1)
{
 $headeralerts = $headeralerts. ajoutPossessionJeu($user->data['user_id'], $_POST['id_jeu']);
}
else if(isset($_POST['validerInformationsPossessionsJeuxSuivants']) && $user->data['user_id']!=1)
{
 $headeralerts = $headeralerts. ajoutPossessionMultiplesJeux($user->data['user_id']);
}
if(isset($_POST['validerInformationsPossessionAccessoire']) && $user->data['user_id']!=1)
{
 $headeralerts = $headeralerts. ajoutPossessionAccessoire($user->data['user_id'], $_POST['id_accessoire']);
}
else if(isset($_POST['validerInformationsPossessionsAccessoiresSuivants']) && $user->data['user_id']!=1)
{
 $headeralerts = $headeralerts. ajoutPossessionMultiplesAccessoires($user->data['user_id']);
}
if(isset($_POST['validerInformationsPossessionConsole']) && $user->data['user_id']!=1)
{
 $headeralerts = $headeralerts. ajoutPossessionConsole($user->data['user_id'], $_POST['id_console']);
}
else if(isset($_POST['validerInformationsPossessionsConsolesSuivantes']) && $user->data['user_id']!=1)
{
 $headeralerts = $headeralerts. ajoutPossessionMultiplesConsoles($user->data['user_id']);
}


if(isset($_POST['validerAjoutPossessionJeu']) && !isset($_POST['ajoutsPossessionsMultiplesReussies']))
{
	$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php' => "Ajouter un(des) jeu(x) dans votre collection"));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	$k=0;
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			$k = $key;
			break;
		}
	}
	unset($_POST[$k]);
	 affiche_ajout_possession_jeu(Jeu::findDetails(intval($k)), Details_Jeu::findAllVersions(intval($k)));
}
else if(isset($_POST['validerAjoutPossessionAccessoire'])  && !isset($_POST['ajoutsPossessionsMultiplesReussies']))
{
	$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php' => "Ajouter un(des) accessoire(s) dans votre collection"));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	$k=0;
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			$k = $key;
			break;
		}
	}
	unset($_POST[$k]);
	 affiche_ajout_possession_accessoire(Accessoire::findDetails(intval($k)), Version_Accessoire::findAllVersions(intval($k)));
}
else if(isset($_POST['validerAjoutPossessionConsole']) && !isset($_POST['ajoutsPossessionsMultiplesReussies']))
{
	$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php' => "Ajouter une(des) console(s) dans votre collection"));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	$k=0;
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			$k = $key;
			break;
		}
	}
	unset($_POST[$k]);
	 affiche_ajout_possession_console(Console::findDetails(intval($k)), Version_Console::findAllVersions(intval($k)));
}
else if(isset($_POST['incomplet']))
{
	$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=add' => "Ajouter un jeu"));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	 affiche_ajout_informations_manquantes($_POST['ajout_plateforme'], $_POST['ajout_developpeur'], $_POST['ajout_type'], $_POST['ajout_groupe'], $_POST['ajout_editeur'], $_POST['ajout_langue'],$_POST['ajout_support'],$_POST['ajout_format'],$_POST['ajout_region'],$_POST['ajout_edition'],$_POST['ajout_commande'], Editeur::findAll(), Groupe::findAll());
	$_POST['incomplet']=0;
}
else if(isset($_GET['action']))
{
	if($_GET['action']=="add")
	{
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=add' => "Ajouter un jeu"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		 affiche_ajout_jeu(Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Nom_Jeu::findAll(), Plateforme::findAll(), Region::findAll(), Type_Jeu::findAll(), Groupe::findAll(), Commande::findAll(), Langue::findAll(), Support::findAll(), Format::findAll(), Accessoire::findAutocompleteValues());
		
	}
	else if($_GET['action']=="addAccessoire")
	{
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=addAccessoire' => "Ajouter un accessoire"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		affiche_ajout_accessoire(Type_Accessoire::findAll(), Editeur::findAll(), Plateforme::findAll(), Region::findAll());
		
	}
	else if($_GET['action']=="addConsole")
	{
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=addConsole' => "Ajouter une console"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		 affiche_ajout_console(Editeur::findAll(), Plateforme::findAll(), Region::findAll(), Accessoire::findAutocompleteValues(), Jeu::findAutocompleteValues());
		
	}
	else if($_GET['action']=="addVersion")
	{
		if(isset($_GET['jeu']))
		{
			$jeu = Jeu::findDetails(intval($_GET['jeu']));
			$nom = $jeu['nom_jeu'];
			$navbits = (array('bddjv.php' => "Accueil de la base","bddjv.php?action=addVersion&jeu=".$_GET['jeu'] => "Ajouter une versrion du jeu"));
			print_header($navbits, $headeralerts, $navbar, $user, 0);
			 affiche_ajout_version_jeu(intval($_GET['jeu']), $nom, Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Nom_Jeu::findAll(), Plateforme::findAll(), Region::findAll(), Type_Jeu::findAll(), Groupe::findAll(), Commande::findAll(), Langue::findAll(), Support::findAll(), Format::findAll(), Accessoire::findAutocompleteValues());
			
		}
		else if(isset($_GET['accessoire']))
		{
			$accessoire = Accessoire::findById(intval($_GET['accessoire']));
			$nom = $accessoire->getAttr('nom_accessoire');
			$navbits = (array('bddjv.php' => "Accueil de la base","bddjv.php?action=addVersion&accessoire=".$_GET['accessoire'] => "Ajouter une versrion de l'accessoire"));
			print_header($navbits, $headeralerts, $navbar, $user, 0);
			 affiche_ajout_version_accessoire(intval($_GET['accessoire']), $nom, Region::findAll());
			
		}
		else if(isset($_GET['console']))
		{
			$console = Console::findById(intval($_GET['console']));
			$nom = $console->getAttr('nom_console');
			$navbits = (array('bddjv.php' => "Accueil de la base","bddjv.php?action=addVersion&console=".$_GET['console'] => "Ajouter une versrion de la console"));
			print_header($navbits, $headeralerts, $navbar, $user, 0);
			 affiche_ajout_version_console(intval($_GET['console']), $nom, Region::findAll());
			
		}
	}
	else if($_GET['action']=="find")
	{
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=find' => "Recherche"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		if(isset($_POST['srcJeu']))
		{
			$jeux = Jeu::findAllDetailsBySearch($_POST['jeu'], $_POST['plateforme'], $_POST['developpeur'], $_POST['type_jeu'], $_POST['groupe'], $_POST['region'], $_POST['edition'], $_POST['editeur'], $_POST['support'], $_POST['format'], $_POST['langue'], $_POST['commande'], $_POST['autre_plateforme']);
			$collection = array();
			$canAdd = 0;
			if(isset($user->data['user_id']) && $user->data['user_id']!=1)
			{
				$collection = Possede_Jeu::findAllIdByUser($user->data['user_id']);
				$canAdd = 1;
			}
			affiche_liste_tout_jeux($jeux, Commande::findAll(), Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Format::findAll(), Groupe::findAll(), Langue::findAll(), Plateforme::findAll(), Region::findAll(), Support::findAll(), Type_jeu::findAll(), $collection, $canAdd);
			echo "<br><br><div class='lienAdmin'><a href='bddjv.php?action=find'>Effectuer une nouvelle recherche</a></div>";
		}
		else if(isset($_POST['srcAcc']))
		{	
			$acc = Accessoire::findAllDetailsBySearch($_POST['accessoire'], $_POST['plateforme'], $_POST['region'], $_POST['editeur'], $_POST['type_accessoire'], $_POST['zone']);
			$collection = array();
			$canAdd = 0;
			if(isset($user->data['user_id']) && $user->data['user_id']!=1)
			{
				$collection = Possede_Accessoire::findAllIdByUser($user->data['user_id']);
				$canAdd = 1;
			}
			affiche_liste_tout_accessoires($acc, Editeur::findAll(), Plateforme::findAll(), Region::findAll(), Type_Accessoire::findAll(), $collection, $canAdd);
			echo "<br><br><div class='lienAdmin'><a href='bddjv.php?action=find'>Effectuer une nouvelle recherche</a></div>";
		}
		else if(isset($_POST['srcPac']))
		{
			$pac = Console::findAllDetailsBySearch($_POST['pack'], $_POST['plateforme'], $_POST['region'], $_POST['editeur']);
			$collection = array();
			$canAdd = 0;
			if(isset($user->data['user_id']) && $user->data['user_id']!=1)
			{
				$collection = Possede_Console::findAllIdByUser($user->data['user_id']);
				$canAdd = 1;
			}
			affiche_liste_toutes_consoles($pac, Editeur::findAll(), Plateforme::findAll(), Region::findAll(), $collection, $canAdd);
			echo "<br><br><div class='lienAdmin'><a href='bddjv.php?action=find'Effectuer une nouvelle recherche</a></div>";
		}
		else
		{
			 afficher_recherche(Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Plateforme::findAll(), Region::findAll(), Type_Jeu::findAll(), Type_Accessoire::findAll(), Groupe::findAll(), Commande::findAll(), Langue::findAll(), Support::findAll(), Format::findAll());
		}
		
	}
	else if($_GET['action']=="search")
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Dû au très grand nombre de données, il se peut que le chargement de la page soit un peu long et que vous ayez des problèes d\'affichages.\nNous vous conseillons plutôt d\'utiliser la recherche par plateformes.");</script>');
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=search' => "Recherche avancée"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		$collection = array();
		$canAdd = 0;
		if(isset($user->data['user_id']) && $user->data['user_id']!=1)
		{
			$collection = Possede_Jeu::findAllIdByUser($user->data['user_id'] && $user->data['user_id']!=1);
			$canAdd = 1;
		}
		 affiche_liste_tout_jeux(Jeu::findAllDetails(), Commande::findAll(), Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Format::findAll(), Groupe::findAll(), Langue::findAll(), Plateforme::findAll(), Region::findAll(), Support::findAll(), Type_jeu::findAll(), $collection, $canAdd);
	}
	else if($_GET['action']=="searchAccessoires")
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Dû au très grand nombre de données, il se peut que le chargement de la page soit un peu long et que vous ayez des problèes d\'affichages.\nNous vous conseillons plutôt d\'utiliser la recherche par plateformes.");</script>');
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=searchAccessoire' => "Recherche avancée d'un accessoire"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		$collection = array();
		$canAdd = 0;
		if(isset($user->data['user_id']) && $user->data['user_id']!=1)
		{
			$collection = Possede_Accessoire::findAllIdByUser($user->data['user_id']);
			$canAdd = 1;
		}
		 affiche_liste_tout_accessoires(Accessoire::findAllDetails(), Editeur::findAll(), Plateforme::findAll(), Region::findAll(), Type_accessoire::findAll(), $collection, $canAdd);
		
	}
	else if($_GET['action']=="searchConsoles")
	{
		$headeralerts = $headeralerts. ('<script>alertify.alert("Dû au très grand nombre de données, il se peut que le chargement de la page soit un peu long et que vous ayez des problèes d\'affichages.\nNous vous conseillons plutôt d\'utiliser la recherche par plateformes.");</script>');
		$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=searchAccessoire' => "Recherche avancée d'un accessoire"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		$collection = array();
		$canAdd = 0;
		if(isset($user->data['user_id']) && $user->data['user_id']!=1)
		{
			$collection = Possede_Console::findAllIdByUser($user->data['user_id']);
			$canAdd = 1;
		}
		 affiche_liste_toutes_consoles(Console::findAllDetails(), Editeur::findAll(), Plateforme::findAll(), Region::findAll(), $collection, $canAdd);
		
	}
	else if($_GET['action']=="adm")
	{
		if(in_array($user->data['group_id'], Base::getModos()))
		{
			$navbits = (array('bddjv.php' => "Accueil de la base",'bddjv.php?action=adm' =>"Panneau d'administration"));
			
			if(isset($jeu))
			{
				$jeu = Jeu::findDetails(intval($jeu));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu'],"bddjv.php?action=adm&jeu=".$jeu['id_jeu']=>'Modifier '.$jeu['nom_jeu']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_jeu($jeu, Details_Jeu::findAllVersions($jeu['id_jeu']), Nom_jeu::findAll(), Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Nom_Jeu::findAll(), Plateforme::findAll(), Region::findAll(), Type_Jeu::findAll(), Groupe::findAll(), Commande::findAll(), Langue::findAll(), Support::findAll(), Format::findAll(), Accessoire::findAutocompleteValues());
				
			}
			elseif(isset($commande))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_commande(Commande::findById($commande));
				
			}
			else if(isset($developpeur))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_developpeur(Developpeur::findById($developpeur));
				
			}
			else if(isset($editeur))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_editeur(Editeur::findById($editeur),Description_Marque::findById($editeur));
				
			}
			else if(isset($edition))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_edition(Edition::findById($edition));
				
			}
			else if(isset($format))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_format(Format::findById($format));
				
			}
			else if(isset($groupe))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_groupe(Groupe::findById($groupe), Groupe::findAll());
				
			}
			else if(isset($langue))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_langue(Langue::findById($langue));
				
			}
			else if(isset($plateforme))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_plateforme(Plateforme::findById($plateforme), Editeur::findAll());
				
			}
			else if(isset($region))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_region(Region::findById($region));
				
			}
			else if(isset($support))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_support(Support::findById($support));
				
			}
			else if(isset($type))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_type_jeu(Type_Jeu::findById($type));
				
			}
			else if(isset($typeAccessoire))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_type_accessoire(Type_Accessoire::findById($typeAccessoire));
				
			}
			else if(isset($_GET['jeu']))
			{
				$jeu = Jeu::findDetails(intval($_GET['jeu']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu'],"bddjv.php?action=adm&jeu=".$jeu['id_jeu']=>'Modifier '.$jeu['nom_jeu']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_jeu($jeu, Details_Jeu::findAllVersions(intval($_GET['jeu'])), Nom_jeu::findAll(), Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Nom_Jeu::findAll(), Plateforme::findAll(), Region::findAll(), Type_Jeu::findAll(), Groupe::findAll(), Commande::findAll(), Langue::findAll(), Support::findAll(), Format::findAll(), Accessoire::findAutocompleteValues());
				
			}
			else if(isset($_GET['validerJeu']))
			{
				Jeu::validerJeu(intval($_GET['validerJeu']));
				$jeu = Jeu::findDetails(intval($_GET['validerJeu']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				affiche_jeu($jeu, Details_Jeu::findAllVersions(intval($_GET['validerJeu'])), $user);
				
			}
			else if(isset($_GET['supprJeu']))
			{
				$jeu = Jeu::findDetails(intval($_GET['supprJeu']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo '<script>
						alertify.confirm("Êtes vous sûr de vouloir supprimer ce jeu ?", function (e) {
							if (e) {
								self.location.href ="bddjv.php?action=adm&validationSupprJeu='.$_GET['supprJeu'].'";
							} else {
								alertify.error("Suppression annulée");
							}
						});
					</script>';
				affiche_jeu($jeu, Details_Jeu::findAllVersions(intval($_GET['supprJeu'])), $user);
				
			}
			else if(isset($_GET['validationSupprJeu']))
			{
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("bddjv.php?action=adm&supprJeu=".$_GET['validationSupprJeu']))=="bddjv.php?action=adm&supprJeu=".$_GET['validationSupprJeu'])
				{
					$jeu = Jeu::findDetails(intval($_GET['validationSupprJeu']));
					Jeu::supprimerJeu(intval($_GET['validationSupprJeu']));
					$headeralerts = $headeralerts.'<script>
									alertify.success("Jeu supprimé");
							</script>';
					$navbits = (array('bddjv.php' => "Accueil de la base"));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 $coprs.affiche_marques(Editeur::findAllMarques());
					
				}
				else
				{
					$headeralerts = $headeralerts. '<script>
									alertify.alert("Le jeu que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
							</script>';
					$navbits = (array('bddjv.php' => "Accueil de la base"));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 $coprs.affiche_marques(Editeur::findAllMarques());
					
				}
			}
			else if(isset($_GET['validerVersionJeu']))
			{
				Details_Jeu::validerVersionJeu(intval($_GET['validerVersionJeu']));
				$id=0;
				$d = Details_Jeu::findById(intval($_GET['validerVersionJeu']));
				if($d!=null)
				{
					$id = $d->getAttr('id_jeu');
				}
				$jeu = Jeu::findDetails(strip_tags($id));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				affiche_jeu($jeu, Details_Jeu::findAllVersions(strip_tags($id)), $user);
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
				
			}
			else if(isset($_GET['supprVersionJeu']))
			{
				$id=0;
				$d = Details_Jeu::findById(intval($_GET['supprVersionJeu']));
				if($d!=null)
				{
					if($d->getAttr('id_jeu')!='')
					{
						$id = $d->getAttr('id_jeu');
					}
				}
				$jeu = Jeu::findDetails(strip_tags($id));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo '<script>
						alertify.confirm("Êtes vous sûr de vouloir supprimer cette version de jeu ?", function (e) {
							if (e) {
								self.location.href ="bddjv.php?action=adm&validationSupprVersionJeu='.intval($_GET['supprVersionJeu']).'";
							} else {
								alertify.error("Suppression annulée");
							}
						});
					</script>';
				affiche_jeu($jeu, Details_Jeu::findAllVersions($id), $user);
				
			}
			else if(isset($_GET['validationSupprVersionJeu']))
			{
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("bddjv.php?action=adm&supprVersionJeu=".$_GET['validationSupprVersionJeu']))=="bddjv.php?action=adm&supprVersionJeu=".$_GET['validationSupprVersionJeu'])
				{
					$id=0;
					$d = Details_Jeu::findById(intval($_GET['validationSupprVersionJeu']));
					if($d!=null)
					{
						if($d->getAttr('id_jeu')!='')
						{
							$id = $d->getAttr('id_jeu');
						}
					}
					Details_Jeu::supprimerVersionJeu(intval($_GET['validationSupprVersionJeu']));
					echo '<script>
									alertify.success("Version supprimée");
							</script>';
					$jeu = Jeu::findDetails($id);
					$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					affiche_jeu($jeu, Details_Jeu::findAllVersions($id), $user);
					
				}
				else
				{
					$id=0;
					$d = Details_Jeu::findById(intval($_GET['validationSupprVersionJeu']));
					if($d!=null)
					{
						if($d->getAttr('id_jeu')!='')
						{
							$id = $d->getAttr('id_jeu');
						}
					}
					$jeu = Jeu::findDetails($id);
					$headeralerts = $headeralerts. '<script>
									alertify.alert("La version du jeu que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
							</script>';
					$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					affiche_jeu($jeu, Details_Jeu::findAllVersions($id), $user);
					
				}
			}
			else if(isset($_GET['accessoire']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_accessoire(Accessoire::findDetails(intval($_GET['accessoire'])), Version_Accessoire::findAllVersions(intval($_GET['accessoire'])), Type_Accessoire::findAll(), Editeur::findAll(), Plateforme::findAll(), Region::findAll());
				
			}
			else if(isset($_GET['validerAccessoire']))
			{
				Accessoire::validerAccessoire(intval($_GET['validerAccessoire']));
				$Accessoire = Accessoire::findDetails(intval($_GET['validerAccessoire']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions(intval($_GET['validerAccessoire'])), $user);
				
			}
			else if(isset($_GET['supprAccessoire']))
			{
				$Accessoire = Accessoire::findDetails(intval($_GET['supprAccessoire']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo '<script>
						alertify.confirm("Êtes vous sûr de vouloir supprimer cet accessoire ?", function (e) {
							if (e) {
								self.location.href ="bddjv.php?action=adm&validationSupprAccessoire='.intval($_GET['supprAccessoire']).'";
							} else {
								alertify.error("Suppression annulée");
							}
						});
					</script>';
				affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions(intval($_GET['supprAccessoire'])), $user);
				
			}
			else if(isset($_GET['validationSupprAccessoire']))
			{
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("bddjv.php?action=adm&supprAccessoire=".$_GET['validationSupprAccessoire']))=="bddjv.php?action=adm&supprAccessoire=".$_GET['validationSupprAccessoire'])
				{
					$Accessoire = Accessoire::findDetails(intval($_GET['validationSupprAccessoire']));
					Accessoire::supprimerAccessoire(intval($_GET['validationSupprAccessoire']));
					echo '<script>
									alertify.success("Accessoire supprimé");
							</script>';
					$navbits = (array('bddjv.php' => "Accueil de la base"));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 affiche_marques(Editeur::findAllMarques());
					
				}
				else
				{
					$headeralerts = $headeralerts. '<script>
									alertify.alert("L\'accessoire que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
							</script>';
					$navbits = (array('bddjv.php' => "Accueil de la base"));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 affiche_marques(Editeur::findAllMarques());
					
				}
			}
			else if(isset($_GET['validerVersionAccessoire']))
			{
				Version_Accessoire::validerVersionAccessoire(intval($_GET['validerVersionAccessoire']));
				$id=0;
				$d = Version_Accessoire::findById(intval($_GET['validerVersionAccessoire']));
				if($d!=null)
				{
					if($d->getAttr('id_accessoire')!='')
					{
						$id = $d->getAttr('id_accessoire');
					}
				}
				$Accessoire = Accessoire::findDetails($id);
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions($id), $user);
				
			}
			else if(isset($_GET['supprVersionAccessoire']))
			{
				$id=0;
				$d = Version_Accessoire::findById(intval($_GET['supprVersionAccessoire']));
				if($d!=null)
				{
					if($d->getAttr('id_accessoire')!='')
					{
						$id = $d->getAttr('id_accessoire');
					}
				}
				$Accessoire = Accessoire::findDetails($id);
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo '<script>
						alertify.confirm("Êtes vous sûr de vouloir supprimer cette version de l\'accessoire ?", function (e) {
							if (e) {
								self.location.href ="bddjv.php?action=adm&validationSupprVersionAccessoire='.intval($_GET['supprVersionAccessoire']).'";
							} else {
								alertify.error("Suppression annulée");
							}
						});
					</script>';
				affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions($id), $user);
				
			}
			else if(isset($_GET['validationSupprVersionAccessoire']))
			{
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("bddjv.php?action=adm&supprVersionAccessoire=".$_GET['validationSupprVersionAccessoire']))=="bddjv.php?action=adm&supprVersionAccessoire=".$_GET['validationSupprVersionAccessoire'])
				{
					$id=0;
					$d = Version_Accessoire::findById(intval($_GET['validationSupprVersionAccessoire']));
					if($d!=null)
					{
						if($d->getAttr('id_accessoire')!='')
						{
							$id = $d->getAttr('id_accessoire');
						}
					}
					Version_Accessoire::supprimerVersionAccessoire(intval($_GET['validationSupprVersionAccessoire']));
					$Accessoire = Accessoire::findDetails($id);
					$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					echo '<script>
									alertify.success("Version supprimée");
							</script>';
					 affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions($id), $user);
					
				}
				else
				{
					$headeralerts = $headeralerts. '<script>
									alertify.alert("La version de l\'accessoire que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
							</script>';
					$id=0;
					$d = Version_Accessoire::findById(intval($_GET['validationSupprVersionAccessoire']));
					if($d!=null)
					{
						if($d->getAttr('id_accessoire')!='')
						{
							$id = $d->getAttr('id_accessoire');
						}
					}
					$Accessoire = Accessoire::findDetails($id);
					$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions($id), $user);
					
				}
			}
			else if(isset($_GET['console']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_console(Console::findDetails(intval($_GET['console'])), Version_Console::findAllVersions(intval($_GET['console'])), Editeur::findAll(), Plateforme::findAll(), Region::findAll(), Accessoire::findAutocompleteValues(), Jeu::findAutocompleteValues());
			}
			else if(isset($_GET['validerConsole']))
			{
				Console::validerConsole(intval($_GET['validerConsole']));
				$Console = Console::findDetails(intval($_GET['validerConsole']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewConsole&id=".$Console['id_console']=>$Console['nom_console']));
				 affiche_console($Console, Version_Console::findAllVersions(intval($_GET['validerConsole'])), $user);
				
			}
			else if(isset($_GET['supprConsole']))
			{
				$Console = Console::findDetails(intval($_GET['supprConsole']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewConsole&id=".$Console['id_console']=>$Console['nom_console']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo '<script>
						alertify.confirm("Êtes vous sûr de vouloir supprimer ce pack ?", function (e) {
							if (e) {
								self.location.href ="bddjv.php?action=adm&validationSupprConsole='.intval($_GET['supprConsole']).'";
							} else {
								alertify.error("Suppression annulée");
							}
						});
					</script>';
				affiche_console($Console, Version_Console::findAllVersions(intval($_GET['supprConsole'])), $user);
			}
			else if(isset($_GET['validationSupprConsole']))
			{
				$navbits = (array('bddjv.php' => "Accueil de la base"));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("bddjv.php?action=adm&supprConsole=".$_GET['validationSupprConsole']))=="bddjv.php?action=adm&supprConsole=".$_GET['validationSupprConsole'])
				{
					$Console = Console::findDetails(intval($_GET['validationSupprConsole']));
					Console::supprimerConsole(intval($_GET['validationSupprConsole']));
					echo '<script>
									alertify.success("Pack supprimé");
							</script>';
					affiche_marques(Editeur::findAllMarques());
				}
				else
				{
					$headeralerts = $headeralerts. '<script>
									alertify.alert("La console que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
							</script>';
					$coprs.affiche_marques(Editeur::findAllMarques());
				}
				
			}
			else if(isset($_GET['validerVersionConsole']))
			{
				$Console = Console::findDetails($id);
				Version_Console::validerVersionConsole(intval($_GET['validerVersionConsole']));
				$id=0;
				$d = Version_Console::findById(intval($_GET['validerVersionConsole']));
				if($d!=null)
				{
					if($d->getAttr('id_console')!='')
					{
						$id = $d->getAttr('id_console');
					}
				}
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewConsole&id=".$Console['id_console']=>$Console['nom_console']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_console($Console, Version_Console::findAllVersions($id), $user);
				
			}
			else if(isset($_GET['supprVersionConsole']))
			{
				$id=0;
				$d = Version_Console::findById(intval($_GET['supprVersionConsole']));
				if($d!=null)
				{
					if($d->getAttr('id_console')!='')
					{
						$id = $d->getAttr('id_console');
					}
				}
				$Console = Console::findDetails($id);
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewConsole&id=".$Console['id_console']=>$Console['nom_console']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo '<script>
						alertify.confirm("Êtes vous sûr de vouloir supprimer cette version du pack ?", function (e) {
							if (e) {
								self.location.href ="bddjv.php?action=adm&validationSupprVersionConsole='.intval($_GET['supprVersionConsole']).'";
							} else {
								alertify.error("Suppression annulée");
							}
						});
					</script>';
				affiche_Console($Console, Version_Console::findAllVersions($id), $user);
				
				}
			else if(isset($_GET['validationSupprVersionConsole']))
			{
				if(substr($_SERVER['HTTP_REFERER'], strlen($_SERVER['HTTP_REFERER'])-strlen("bddjv.php?action=adm&supprVersionConsole=".$_GET['validationSupprVersionConsole']))=="bddjv.php?action=adm&supprVersionConsole=".$_GET['validationSupprVersionConsole'])
				{
					$id=0;
					$d = Version_Console::findById(intval($_GET['validationSupprVersionConsole']));
					if($d!=null)
					{
						if($d->getAttr('id_console')!='')
						{
							$id = $d->getAttr('id_console');
						}
					}
					Version_Console::supprimerVersionConsole(intval($_GET['validationSupprVersionConsole']));
					$headeralerts = $headeralerts.'<script>
									alertify.success("Version supprimée");
							</script>';
					$Console = Console::findDetails($id);
					$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewConsole&id=".$Console['id_console']=>$Console['nom_console']));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 affiche_console($Console, Version_Console::findAllVersions($id), $user);
					
				}
				else
				{
					$headeralerts = $headeralerts. '<script>
									alertify.alert("La version de la console que vous avez essayé de supprimer ne pourras pas l\'être car la procédure de suppression n\'a pas été respectée");
							</script>';
					$id=0;
					$d = Version_Console::findById(intval($_GET['validationSupprVersionConsole']));
					if($d!=null)
					{
						if($d->getAttr('id_console')!='')
						{
							$id = $d->getAttr('id_console');
						}
					}
					$Console = Console::findDetails($id);
					$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewConsole&id=".$Console['id_console']=>$Console['nom_console']));
					print_header($navbits, $headeralerts, $navbar, $user, 0);
					 affiche_console($Console, Version_Console::findAllVersions($id), $user);
					
				}
			}
			elseif(isset($_GET['commande']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_commande(Commande::findById(intval($_GET['commande'])));
				
			}
			else if(isset($_GET['developpeur']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_developpeur(Developpeur::findById(intval($_GET['developpeur'])));
				
			}
			else if(isset($_GET['editeur']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_editeur(Editeur::findById(intval($_GET['editeur'])),Description_Marque::findById(intval($_GET['editeur'])));
				
			}
			else if(isset($_GET['edition']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_edition(Edition::findById(intval($_GET['edition'])));
				
			}
			else if(isset($_GET['format']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_format(Format::findById(intval($_GET['format'])));
				
			}
			else if(isset($_GET['groupe']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_groupe(Groupe::findById(intval($_GET['groupe'])), Groupe::findAll());
				
			}
			else if(isset($_GET['langue']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_langue(Langue::findById(intval($_GET['langue'])));
				
			}
			else if(isset($_GET['plateforme']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_plateforme(Plateforme::findById(intval($_GET['plateforme'])), Editeur::findAll());
				
			}
			else if(isset($_GET['region']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_region(Region::findById(intval($_GET['region'])));
				
			}
			else if(isset($_GET['support']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_support(Support::findById(intval($_GET['support'])));
				
			}
			else if(isset($_GET['type']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_type_jeu(Type_Jeu::findById(intval($_GET['type'])));
				
			}
			else if(isset($_GET['typeAccessoire']))
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_type_accessoire(Type_Accessoire::findById(intval($_GET['typeAccessoire'])));
				
			}
			else
			{
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				if(isset($_GET['supprRapport']))
				{
					$rapport = Rapport_Jeu::findById(intval($_GET['supprRapport']));
					$rapport[0]->delete();
				}
				if(isset($_GET['version']) && $_GET['version']=="full")
				{
					set_time_limit(100);
					affiche_administration($user, Jeu::findIncompletes(), Jeu::findMissingInformations(), Jeu::findInvalide(), 
					Details_Jeu::findIncompletes(), null, Details_Jeu::findInvalide(), 
					Commande::findNonValide(), Commande::findUnused(), Commande::findAll(), 
					Developpeur::findNonValide(), Developpeur::findUnused(), Developpeur::findAll(), 
					Editeur::findNonValide(), Editeur::findUnused(), Editeur::findAll(), 
					Edition::findNonValide(), Edition::findUnused(), Edition::findAll(), 
					Format::findNonValide(), Format::findUnused(), Format::findAll(), 
					Groupe::findNonValide(), Groupe::findUnused(), Groupe::findAll(), 
					Langue::findNonValide(), Langue::findUnused(), Langue::findAll(), 
					Plateforme::findNonValide(), Plateforme::findUnused(), Plateforme::findAll(), 
					Region::findNonValide(), Region::findUnused(), Region::findAll(), 
					Support::findNonValide(), Support::findUnused(), Support::findAll(), 
					Type_Jeu::findNonValide(), Type_Jeu::findUnused(), Type_Jeu::findAll(),
					Type_Accessoire::findNonValide(), Type_Accessoire::findUnused(), Type_Accessoire::findAll(),
					Rapport_Jeu::findAll(), Nom_Jeu::findAll(), 
					Accessoire::findInvalide(), Version_Accessoire::findInvalide(),
					Console::findInvalide(), Version_Console::findInvalide());
				}
				else if(isset($_GET['version']) && $_GET['version']=="min")
				{
							affiche_administration_mini($user, 
							Commande::findAll(), 
							Developpeur::findAll(), 
							Editeur::findAll(), 
							Edition::findAll(), 
							Format::findAll(), 
							Groupe::findAll(), 
							Langue::findAll(), 
							Plateforme::findAll(), 
							Region::findAll(), 
							Support::findAll(), 
							Type_Jeu::findAll(),
							Type_Accessoire::findAll(),
							 Nom_Jeu::findAll());
				}
				else
				{
					set_time_limit(100);
					affiche_administration_lite($user, 
					Commande::findNonValide(), Commande::findUnused(), Commande::findAll(), 
					Developpeur::findNonValide(), Developpeur::findUnused(), Developpeur::findAll(), 
					Editeur::findNonValide(), Editeur::findUnused(), Editeur::findAll(), 
					Edition::findNonValide(), Edition::findUnused(), Edition::findAll(), 
					Format::findNonValide(), Format::findUnused(), Format::findAll(), 
					Groupe::findNonValide(), Groupe::findUnused(), Groupe::findAll(), 
					Langue::findNonValide(), Langue::findUnused(), Langue::findAll(), 
					Plateforme::findNonValide(), Plateforme::findUnused(), Plateforme::findAll(), 
					Region::findNonValide(), Region::findUnused(), Region::findAll(), 
					Support::findNonValide(), Support::findUnused(), Support::findAll(), 
					Type_Jeu::findNonValide(), Type_Jeu::findUnused(), Type_Jeu::findAll(),
					Type_Accessoire::findNonValide(), Type_Accessoire::findUnused(), Type_Accessoire::findAll(),
					Rapport_Jeu::findAll(), Nom_Jeu::findAll());
				}
			}
		}
		else 
		{
			if(isset($_GET['jeu']))
			{
				$jeu = Jeu::findDetails(intval($_GET['jeu']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu'],"bddjv.php?action=adm&jeu=".$jeu['id_jeu']=>'Modifier '.$jeu['nom_jeu']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_jeu(Jeu::findDetails(intval($_GET['jeu'])), Details_Jeu::findAllVersions(intval($_GET['jeu'])), Nom_jeu::findAll(), Developpeur::findAll(), Editeur::findAll(), Edition::findAll(), Nom_Jeu::findAll(), Plateforme::findAll(), Region::findAll(), Type_Jeu::findAll(), Groupe::findAll(), Commande::findAll(), Langue::findAll(), Support::findAll(), Format::findAll(), Accessoire::findAutocompleteValues());
				
			}
			else if(isset($_GET['accessoire']))
			{
				$Accessoire = Accessoire::findDetails(intval($_GET['accessoire']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire'],"bddjv.php?action=adm&accessoire=".$Accessoire['id_accessoire']=>'Modifier '.$Accessoire['nom_accessoire']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_accessoire(Accessoire::findDetails(intval($_GET['accessoire'])), Version_Accessoire::findAllVersions(intval($_GET['accessoire'])), Type_Accessoire::findAll(), Editeur::findAll(), Plateforme::findAll(), Region::findAll());
				
			}
			else if(isset($_GET['console']))
			{
				$Console = Console::findDetails(intval($_GET['console']));
				$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Console['id_console']=>$Console['nom_console'],"bddjv.php?action=adm&console=".$Console['id_console']=>'Modifier '.$Console['nom_console']));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				 affiche_modifier_console(Console::findDetails(intval($_GET['console'])), Version_Console::findAllVersions(intval($_GET['console'])), Editeur::findAll(), Plateforme::findAll(), Region::findAll(), Accessoire::findAutocompleteValues(), Jeu::findAutocompleteValues());
			}
			//TODO Supprimer la modification des accessoires / jeux / consoles
			else
			{
				$navbits = (array('bddjv.php' =>"Accueil de la base"));
				print_header($navbits, $headeralerts, $navbar, $user, 0);
				echo "Vous n'avez pas l'autorisation de voir cette page.<br>
				<a href='bddjv.php'>Retourner à l'accueil</a>";
			}
			
		}
	}
	else if($_GET['action']=="view" && isset($_GET['id']))
	{
		$jeu = Jeu::findDetails(intval($_GET['id']));
		$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$jeu['id_editeur_plateforme']=>$jeu['nom_editeur_plateforme'],"bddjv.php?plateforme=".$jeu['id_plateforme']=>$jeu['nom_plateforme'],"bddjv.php?action=view&id=".$jeu['id_jeu']=>$jeu['nom_jeu']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		 affiche_jeu($jeu, Details_Jeu::findAllVersions(intval($_GET['id'])), $user);
		
	}
	else if($_GET['action']=="viewAccessoire" && isset($_GET['id']))
	{
		$Accessoire = Accessoire::findDetails(intval($_GET['id']));
		$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Accessoire['id_editeur_plateforme']=>$Accessoire['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Accessoire['id_plateforme']=>$Accessoire['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Accessoire['id_accessoire']=>$Accessoire['nom_accessoire']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		 affiche_accessoire($Accessoire, Version_Accessoire::findAllVersions(intval($_GET['id'])), $user);
		
	}
	else if($_GET['action']=="viewConsole" && isset($_GET['id']))
	{
		$Console = Console::findDetails(intval($_GET['id']));
		$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$Console['id_editeur_plateforme']=>$Console['nom_editeur_plateforme'],"bddjv.php?plateforme=".$Console['id_plateforme']=>$Console['nom_plateforme'],"bddjv.php?action=viewAccessoire&id=".$Console['id_console']=>$Console['nom_console']));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		 affiche_console($Console, Version_Console::findAllVersions(intval($_GET['id'])), $user);
		
	}
	else
	{
		$navbits = (array('bddjv.php' =>"Accueil de la base"));
		print_header($navbits, $headeralerts, $navbar, $user, 0);
		 affiche_marques(Editeur::findAllMarques());
		
	}
}
else if(isset($_GET['plateforme']))
{
	$plateforme ='';
	$id =0;
	$idMarque =0;
	$nomEditeur='';
	$DescriptionPlateforme ='';
	$p = Plateforme::findById(intval($_GET['plateforme']));
	if($p!=null)
	{
		$plateforme = $p->getAttr('nom_plateforme');
		$id = $p->getAttr('id_plateforme');
		$idMarque = $p->getAttr('id_editeur');
		$DescriptionPlateforme = $p->getAttr('description_plateforme');
	}
	$e = Editeur::findById($idMarque);
	if($e!=null)
	{
		$nomEditeur = $e->getAttr('nom_editeur');
	}
	$collection = array();
	$collectionC = array();
	$collectionA = array();
	$canAdd = 0;
	if(isset($user->data['user_id']) && $user->data['user_id']!=1)
	{
		$collection = Possede_Jeu::findAllIdByUser($user->data['user_id']);
		$collectionC = Possede_Console::findAllIdByUser($user->data['user_id']);
		$collectionA = Possede_Accessoire::findAllIdByUser($user->data['user_id']);
		$canAdd = 1;
	}
	$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$idMarque=>$nomEditeur,'bddjv.php?plateforme='.$id=>$plateforme));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	 affiche_plateforme(Jeu::findAllDetailsByPlateforme($id), $plateforme, $DescriptionPlateforme, $id, $idMarque, $nomEditeur, $user, Commande::findAll(), Developpeur::findAllInPlateforme($id), Editeur::findAllInPlateforme($id), Edition::findAllInPlateforme($id), Format::findAllInPlateforme($id), Groupe::findAllInPlateforme($id), Langue::findAllInPlateforme($id), Plateforme::findAllInPlateforme($id), Region::findAllInPlateforme($id), Support::findAllInPlateforme($id), Type_jeu::findAllInPlateforme($id), Type_accessoire::findAllInPlateforme($id), $collection, $collectionC, $collectionA, $canAdd);
}
else if(isset($_GET['plateformeLite']))
{
	$plateforme ='';
	$id =0;
	$idMarque =0;
	$nomEditeur='';
	$DescriptionPlateforme ='';
	$p = Plateforme::findById(intval($_GET['plateformeLite']));
	if($p!=null)
	{
		$plateforme = $p->getAttr('nom_plateforme');
		$id = $p->getAttr('id_plateforme');
		$idMarque = $p->getAttr('id_editeur');
		$DescriptionPlateforme = $p->getAttr('description_plateforme');
	}
	$e = Editeur::findById($idMarque);
	if($e!=null)
	{
		$nomEditeur = $e->getAttr('nom_editeur');
	}
	$collection = array();
	$collectionC = array();
	$collectionA = array();
	$canAdd = 0;
	if(isset($user->data['user_id']) && $user->data['user_id']!=1)
	{
		$collection = Possede_Jeu::findAllIdByUser($user->data['user_id']);
		$collectionC = Possede_Console::findAllIdByUser($user->data['user_id']);
		$collectionA = Possede_Accessoire::findAllIdByUser($user->data['user_id']);
		$canAdd = 1;
	}
	$navbits = (array('bddjv.php'=>"Accueil de la base","bddjv.php?marque=".$idMarque=>$nomEditeur,'bddjv.php?plateformeLite='.$id=>$plateforme));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	affiche_plateforme_lite($plateforme, $DescriptionPlateforme, $id, $collection, $collectionC, $collectionA, $canAdd, $user);
}
else if(isset($_GET['marque']))
{
	$description = '';
	$nom = '';
	$nom = 0;
	$d = Description_Marque::findById(intval($_GET['marque']));
	if($d!=null)
	{
		$description = $d->getAttr('description_marque');
	}
	$e = Editeur::findById(intval($_GET['marque']));
	if($e!=null)
	{
		$nom = $e->getAttr('nom_editeur');
		$id = $e->getAttr('id_editeur');
	}
	$navbits = (array('bddjv.php' => "Accueil de la base", "bddjv.php?marque=".$id=>$nom));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	 affiche_plateformes(Plateforme::findByMarque(intval($_GET['marque'])), $description, $id, $nom, $user);
}
else
{
	$navbits = (array('bddjv.php' => "Accueil de la base"));
	print_header($navbits, $headeralerts, $navbar, $user, 0);
	echo affiche_marques(Editeur::findAllMarques());
}

if(in_array($user->data['group_id'], Base::getModos()))
{
	echo "<br><br><div class='lienAdmin'><a href='bddjv.php?action=adm'>Panneau d'administration</a><br>
	<a href='bddjv.php?action=adm&version=min'> - Version minimale - </a><br>
	<a href='bddjv.php?action=adm&version=full'> - Version complète - </a></div>";
}

print_footer();
?> 