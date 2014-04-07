<?php 


include 'affichage.php';
include 'base.php';

include 'accessoire.php';
include 'autre_nom_jeu.php';
include 'autre_plateforme_jeu.php';
include 'bugtracker.php';
include 'details_jeu.php';
include 'commande.php';
include 'commande_jeu.php';
include 'console.php';
include 'console_inclus_accessoire.php';
include 'console_inclus_jeu.php';
include 'developpeur.php';
include 'description_marque.php';
include 'editeur.php';
include 'edition.php';
include 'format.php';
include 'groupe.php';
include 'jeu.php';
include 'jeu_inclus_accessoire.php';
include 'langue.php';
include 'langue_jeu.php';
include 'nom_jeu.php';
include 'plateforme.php';
include 'rapport_jeu.php';
include 'region.php';
include 'support.php';
include 'stats.php';
include 'type_accessoire.php';
include 'type_jeu.php';
include 'version_console.php';
include 'version_accessoire.php';
 
function ajoutBug()
{
	$bug = new Bugtracker();
	$bug->setAttr('description_bug',strip_tags(str_replace("'","\'",$_POST['description_bug'])));
	$bug->setAttr('priorite_bug',0);
	$bug->setAttr('resolu_bug',0);
	$bug->setAttr('type_bug',$_POST['type_bug']);	
	if($bug->save()==0)
	{
		return "<script> $(function(){ alertify.error('Savuegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Suggestion enregistrée')}); </script>";
	}
}

function remplaceCommandes()
{
		$nb=0;
		$commande = Commande::findByName(strip_tags(str_replace("'","\'",$_POST['inCommande'])));
		if(isset($commande[0])) 
		{
			$nb= Commande::remplace($_POST['id'], $commande[0]->getAttr('id_commande'));
		}
		return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
}

function suppressionCommandes()
{
	$i=0;
	foreach(Commande::findUnused() as $c)
	{
		if(isset($_POST[$c->getAttr('id_commande')]))
		{
			if($_POST[$c->getAttr('id_commande')]==1)
			{
				$i++;
				Commande::remplace($c->getAttr('id_commande'), 0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." contrôleur(s) supprimé(s)')}); </script>";
} 

function validationCommandes()
{
	$i=0;
	foreach(Commande::findNonValide() as $c)
	{
		if(isset($_POST[$c->getAttr('id_commande')]))
		{
			if($_POST[$c->getAttr('id_commande')]==1)
			{
				$i+=Commande::validate($c->getAttr('id_commande'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." contrôleur(s) validé(s)')}); </script>";
} 

function remplaceDeveloppeurs()
{
		$nb=0;
		$developpeur = Developpeur::findByName(strip_tags(str_replace("'","\'",$_POST['inDeveloppeur'])));
		if(isset($developpeur[0])) 
		{
			$nb= Developpeur::remplace($_POST['id'], $developpeur[0]->getAttr('id_developpeur'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
}

function suppressionDeveloppeurs()
{
	$i=0;
	foreach(Developpeur::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_developpeur')]))
		{
			if($_POST[$e->getAttr('id_developpeur')]==1)
			{
				$i++;
				Developpeur::remplace($e->getAttr('id_developpeur'), 0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." développeur(s) supprimé(s)')}); </script>";
} 

function validationDeveloppeurs()
{
	$i=0;
	foreach(Developpeur::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_developpeur')]))
		{
			if($_POST[$e->getAttr('id_developpeur')]==1)
			{
				$i+=Developpeur::validate($e->getAttr('id_developpeur'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." développeur(s) validé(s)')}); </script>";
} 

function remplaceEditeurs()
{
		$nb=0;
		$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['inEtiteur'])));
		if(isset($editeur[0])) 
		{
			$nb= Editeur::remplace($_POST['id'], $editeur[0]->getAttr('id_editeur'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionEditeurs()
{
	$i=0;
	foreach(Editeur::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_editeur')]))
		{
			if($_POST[$e->getAttr('id_editeur')]==1)
			{
				$i++;
				Editeur::remplace($e->getAttr('id_editeur'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." éditeur(s) supprimé(s)')}); </script>";
} 

function validationEditeurs()
{
	$i=0;
	foreach(Editeur::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_editeur')]))
		{
			if($_POST[$e->getAttr('id_editeur')]==1)
			{
				$i+=Editeur::validate($e->getAttr('id_editeur'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." éditeur(s) validé(s)')}); </script>";
} 

function remplaceEditions()
{
		$nb=0;
		$edition = Edition::findByName(strip_tags(str_replace("'","\'",$_POST['inEdition'])));
		if(isset($edition[0])) 
		{
			$nb= Edition::remplace($_POST['id'], $edition[0]->getAttr('id_edition'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionEditions()
{
	$i=0;
	foreach(Edition::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_edition')]))
		{
			if($_POST[$e->getAttr('id_edition')]==1)
			{
				$i++;
				Edition::remplace($e->getAttr('id_edition'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." édition(s) supprimée(s)')}); </script>";
} 

function validationEditions()
{
	$i=0;
	foreach(Edition::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_edition')]))
		{
			if($_POST[$e->getAttr('id_edition')]==1)
			{
				$i+=Edition::validate($e->getAttr('id_edition'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." édition(s) validée(s)')}); </script>";
} 

function remplaceFormats()
{
		$nb=0;
		$format = Format::findByName(strip_tags(str_replace("'","\'",$_POST['inFormat'])));
		if(isset($format[0])) 
		{
			$nb= Format::remplace($_POST['id'], $format[0]->getAttr('id_format'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionFormats()
{
	$i=0;
	foreach(Format::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_format')]))
		{
			if($_POST[$e->getAttr('id_format')]==1)
			{
				$i++;
				Format::remplace($e->getAttr('id_format'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." format(s) supprimé(s)')}); </script>";
} 

function validationFormats()
{
	$i=0;
	foreach(Format::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_format')]))
		{
			if($_POST[$e->getAttr('id_format')]==1)
			{
				$i+=Format::validate($e->getAttr('id_format'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." format(s) validé(s)')}); </script>";
} 

function remplaceGroupes()
{
		$nb=0;
		$groupe = Groupe::findByName(strip_tags(str_replace("'","\'",$_POST['inGroupe'])));
		if(isset($groupe[0])) 
		{
			$nb= Groupe::remplace($_POST['id'], $groupe[0]->getAttr('id_groupe'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionGroupes()
{
	$i=0;
	foreach(Groupe::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_groupe')]))
		{
			if($_POST[$e->getAttr('id_groupe')]==1)
			{
				$i++;
				Groupe::remplace($e->getAttr('id_groupe'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." groupe(s) supprimé(s)')}); </script>";
} 

function validationGroupes()
{
	$i=0;
	foreach(Groupe::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_groupe')]))
		{
			if($_POST[$e->getAttr('id_groupe')]==1)
			{
				$i+=Groupe::validate($e->getAttr('id_groupe'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." groupe(s) validé(s)')}); </script>";
} 

function remplaceLangues()
{
		$nb=0;
		$langue = Langue::findByName(strip_tags(str_replace("'","\'",$_POST['inLangue'])));
		if(isset($langue[0])) 
		{
			$nb= Langue::remplace($_POST['id'], $langue[0]->getAttr('id_langue'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionLangues()
{
	$i=0;
	foreach(Langue::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_langue')]))
		{
			if($_POST[$e->getAttr('id_langue')]==1)
			{
				$i++;
				Langue::remplace($e->getAttr('id_langue'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." langue(s) supprimée(s)')}); </script>";
} 

function validationLangues()
{
	$i=0;
	foreach(Langue::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_langue')]))
		{
			if($_POST[$e->getAttr('id_langue')]==1)
			{
				$i+=Langue::validate($e->getAttr('id_langue'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." langue(s) validée(s)')}); </script>";
} 

function remplacePlateformes()
{
		$nb=0;
		$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['inPlateforme'])));
		if(isset($plateforme[0])) 
		{
			$nb= Plateforme::remplace($_POST['id'], $plateforme[0]->getAttr('id_plateforme'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionPlateformes()
{
	$i=0;
	foreach(Plateforme::findUnused() as $e)
	{
		if(isset($_POST[$e->getAttr('id_plateforme')]))
		{
			if($_POST[$e->getAttr('id_plateforme')]==1)
			{
				$i++;
				Plateforme::remplace($e->getAttr('id_plateforme'), 0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." plateforme(s) supprimée(s)')}); </script>";
} 

function validationPlateformes()
{
	$i=0;
	foreach(Plateforme::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_plateforme')]))
		{
			if($_POST[$e->getAttr('id_plateforme')]==1)
			{
				$i+=Plateforme::validate($e->getAttr('id_plateforme'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." plateforme(s) validée(s)')}); </script>";
} 

function remplaceRegions()
{
		$nb=0;
		$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['inRegion'])));
		if(isset($region[0])) 
		{
			$nb= Region::remplace($_POST['id'], $region[0]->getAttr('id_region'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionRegions()
{
	$i=0;
	foreach(Region::findUnused() as $r)
	{
		if(isset($_POST[$r->getAttr('id_region')]))
		{
			if($_POST[$r->getAttr('id_region')]==1)
			{
				$i++;
				Region::remplace($r->getAttr('id_region'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." region(s) supprimée(s)')}); </script>";
} 

function validationRegions()
{
	$i=0;
	foreach(Region::findNonValide() as $r)
	{
		if(isset($_POST[$r->getAttr('id_region')]))
		{
			if($_POST[$r->getAttr('id_region')]==1)
			{
				$i+=Region::validate($r->getAttr('id_region'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." region(s) validée(s)')}); </script>";
} 

function remplaceSupports()
{
		$nb=0;
		$support = Support::findByName(strip_tags(str_replace("'","\'",$_POST['inSupport'])));
		if(isset($support[0])) 
		{
			$nb= Support::remplace($_POST['id'], $support[0]->getAttr('id_support'));
		}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionSupports()
{
	$i=0;
	foreach(Support::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_support')]))
		{
			if($_POST[$e->getAttr('id_support')]==1)
			{
				$i++;
				Support::remplace($e->getAttr('id_support'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." support(s) supprimé(s)')}); </script>";
} 

function validationSupports()
{
	$i=0;
	foreach(Support::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_support')]))
		{
			if($_POST[$e->getAttr('id_support')]==1)
			{
				$i+=Support::validate($e->getAttr('id_support'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." support(s) validé(s)')}); </script>";
} 

function remplaceTypes()
{
	$nb=0;
	$type = Type_Jeu::findByName(strip_tags(str_replace("'","\'",$_POST['inType'])));
	if(isset($type[0])) 
	{
		$nb= Type_Jeu::remplace($_POST['id'], $type[0]->getAttr('id_type_jeu'));
	}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionTypes()
{
	$i=0;
	foreach(Type_Jeu::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_type_jeu')]))
		{
			if($_POST[$e->getAttr('id_type_jeu')]==1)
			{
				$i++;
				Type_Jeu::remplace($e->getAttr('id_type_jeu'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." type(s) supprimé(s)')}); </script>";
} 
 
function validationTypes()
{
	$i=0;
	foreach(Type_Jeu::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_type_jeu')]))
		{
			if($_POST[$e->getAttr('id_type_jeu')]==1)
			{
				$i+=Type_Jeu::validate($e->getAttr('id_type_jeu'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." type(s) validé(s)')}); </script>";
} 

function remplaceTypesAccessoires()
{
	$nb=0;
	$type = Type_Accessoire::findByName(strip_tags(str_replace("'","\'",$_POST['inTypeAcc'])));
	if(isset($type[0])) 
	{
		$nb= Type_Accessoire::remplace($_POST['id'], $type[0]->getAttr('id_type_accessoire'));
	}
	return "<script> $(function(){ alertify.log('".$nb." ligne(s) affectée(s)')}); </script>";
} 

function suppressionTypesAccessoires()
{
	$i=0;
	foreach(Type_Accessoire::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_type_accessoire')]))
		{
			if($_POST[$e->getAttr('id_type_accessoire')]==1)
			{
				$i++;
				Type_Accessoire::remplace($e->getAttr('id_type_accessoire'),0);
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." type(s) supprimé(s)')}); </script>";
} 
 
function validationTypesAccessoires()
{
	$i=0;
	foreach(Type_Accessoire::findNonValide() as $e)
	{
		if(isset($_POST[$e->getAttr('id_type_accessoire')]))
		{
			if($_POST[$e->getAttr('id_type_accessoire')]==1)
			{
				$i+=Type_Accessoire::validate($e->getAttr('id_type_accessoire'));
			}
		}
	}
	return "<script> $(function(){ alertify.log('".$i." type(s) validé(s)')}); </script>";
} 
 
function ajoutDescriptionEditeur()
{
	$d = new Description_Marque();
	$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['nom_editeur'])));
	if(isset($editeur[0])) 
	{
		$d->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
	}
	$d->setAttr('description_marque',  strip_tags(str_replace("'","\'",$_POST["description_editeur"]), "<a><br><img><div><span>"));
	if($d->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Description sauvegardée')}); </script>";
	}
}

function ajoutDeveloppeur()
{
$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$developpeur = new Developpeur();	
	if(isset($_POST["id_developpeur"]))
	{
		$developpeur->setAttr("id_developpeur", strip_tags(str_replace("'","\'",$_POST["id_developpeur"])));
	}
	$developpeur->setAttr("nom_developpeur", strip_tags(str_replace("'","\'",$_POST["nom_developpeur"])));	
	if (isset($_FILES['logo_developpeur']) )
			{
				if($_FILES['logo_developpeur']['name']!='')
				{
					if ($_FILES['logo_developpeur']['error'] > 0)
					{
						switch($_FILES['logo_developpeur']['error'])
						{
							case 1:
								$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
								break;
							case 2:
								$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
								break;
							case 3:
								$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
								break;
							case 4:
								$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
								break;
							case 6:
								$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
								break;
							case 7:
								$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
								break;
							case 8:
								$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
								break;
							default:
								$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
								break;
						}
					}
					elseif ($_FILES['logo_developpeur']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_developpeur']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/developpeur/')) 
						{
							mkdir('img/developpeur/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/developpeur/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_developpeur'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_developpeur']['tmp_name'],$nom);
						$developpeur->setAttr('logo_developpeur', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($developpeur->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Developpeur sauvegardé')}); </script>";
	}
}

function ajoutLangue()
{
	$return= '';
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$langue = new Langue();
	if(isset($_POST["id_langue"]))
	{
		$langue->setAttr("id_langue", strip_tags(str_replace("'","\'",$_POST["id_langue"])));
	}
	$langue->setAttr("nom_langue", strip_tags(str_replace("'","\'",$_POST["nom_langue"])));	
	if (isset($_FILES['logo_langue']) )
			{
				if($_FILES['logo_langue']['name']!='')
				{
					if ($_FILES['logo_langue']['error'] > 0)
					{
						switch($_FILES['logo_langue']['error'])
						{
							case 1:
								$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
								break;
							case 2:
								$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
								break;
							case 3:
								$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
								break;
							case 4:
								$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
								break;
							case 6:
								$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
								break;
							case 7:
								$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
								break;
							case 8:
								$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
								break;
							default:
								$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
								break;
						}
					}
					elseif ($_FILES['logo_langue']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_langue']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/langue/')) 
						{
							mkdir('img/langue/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/langue/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_langue'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_langue']['tmp_name'],$nom);
						$langue->setAttr('logo_langue', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($langue->save()==0)
	{
		return $return."<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return $return."<script> $(function(){ alertify.success('Langue sauvegardée')}); </script>";
	}
}

function ajoutMultiLangue()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_langue-".$i]))
	{
		$langue = new Langue();
		if(isset($_POST["id_langue-".$i]))
		{
			$langue->setAttr("id_langue", strip_tags(str_replace("'","\'",$_POST["id_langue-".$i])));
		}
		$langue->setAttr("nom_langue", strip_tags(str_replace("'","\'",$_POST["nom_langue-".$i])));	
		if (isset($_FILES['logo_langue-'.$i]) )
				{
					if($_FILES['logo_langue-'.$i]['name']!='')
					{
						if ($_FILES['logo_langue-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_langue-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_langue-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_langue-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/langue/')) 
							{
								mkdir('img/langue/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/langue/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_langue-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_langue-'.$i]['tmp_name'],$nom);
							$langue->setAttr('logo_langue', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($langue->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('Editeur sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutSupport()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$support = new Support();
	if(isset($_POST["id_support"]))
	{
		$support->setAttr("id_support", strip_tags(str_replace("'","\'",$_POST["id_support"])));
	}
	$support->setAttr("nom_support", strip_tags(str_replace("'","\'",$_POST["nom_support"])));	
	if (isset($_FILES['logo_support']) )
			{
				if($_FILES['logo_support']['name']!='')
				{
					if ($_FILES['logo_support']['error'] > 0)
					{
							switch($_FILES['logo_support']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_support']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_support']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/support/')) 
						{
							mkdir('img/support/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/support/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_support'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_support']['tmp_name'],$nom);
						$support->setAttr('logo_support', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($support->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Support sauvegardé')}); </script>";
	}
}

function ajoutMultiSupport()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_support-".$i]))
	{
		$support = new support();
		if(isset($_POST["id_support-".$i]))
		{
			$support->setAttr("id_support", strip_tags(str_replace("'","\'",$_POST["id_support-".$i])));
		}
		$support->setAttr("nom_support", strip_tags(str_replace("'","\'",$_POST["nom_support-".$i])));	
		if (isset($_FILES['logo_support-'.$i]) )
				{
					if($_FILES['logo_support-'.$i]['name']!='')
					{
						if ($_FILES['logo_support-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_support-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_support-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_support-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/support/')) 
							{
								mkdir('img/support/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/support/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_support-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_support-'.$i]['tmp_name'],$nom);
							$support->setAttr('logo_support', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($support->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('support sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutFormat()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$format = new Format();
	if(isset($_POST["id_format"]))
	{
		$format->setAttr("id_format", strip_tags(str_replace("'","\'",$_POST["id_format"])));
	}
	$format->setAttr("nom_format", strip_tags(str_replace("'","\'",$_POST["nom_format"])));	
	if (isset($_FILES['logo_format']) )
			{
				if($_FILES['logo_format']['name']!='')
				{
					if ($_FILES['logo_format']['error'] > 0)
					{
							switch($_FILES['logo_format']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_format']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_format']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/format/')) 
						{
							mkdir('img/format/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/format/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_format'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_format']['tmp_name'],$nom);
						$format->setAttr('logo_format', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($format->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Format sauvegardé')}); </script>";
	}
}

function ajoutMultiFormat()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_format-".$i]))
	{
		$format = new format();
		if(isset($_POST["id_format-".$i]))
		{
			$format->setAttr("id_format", strip_tags(str_replace("'","\'",$_POST["id_format-".$i])));
		}
		$format->setAttr("nom_format", strip_tags(str_replace("'","\'",$_POST["nom_format-".$i])));	
		if (isset($_FILES['logo_format-'.$i]) )
				{
					if($_FILES['logo_format-'.$i]['name']!='')
					{
						if ($_FILES['logo_format-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_format-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_format-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_format-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/format/')) 
							{
								mkdir('img/format/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/format/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_format-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_format-'.$i]['tmp_name'],$nom);
							$format->setAttr('logo_format', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($format->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('format sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutEditeur()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$editeur = new Editeur();
	if(isset($_POST["id_editeur"]))
	{
		$editeur->setAttr("id_editeur", strip_tags(str_replace("'","\'",$_POST["id_editeur"])));
	}
	$editeur->setAttr("nom_editeur", strip_tags(str_replace("'","\'",$_POST["nom_editeur"])));	
	if (isset($_FILES['logo_editeur']) )
			{
				if($_FILES['logo_editeur']['name']!='')
				{
					if ($_FILES['logo_editeur']['error'] > 0)
					{
							switch($_FILES['logo_editeur']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_editeur']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_editeur']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/editeur/')) 
						{
							mkdir('img/editeur/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/editeur/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_editeur'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_editeur']['tmp_name'],$nom);
						$editeur->setAttr('logo_editeur', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($editeur->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Editeur sauvegardé')}); </script>";
	}
}

function ajoutMultiEditeur()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_editeur-".$i]))
	{
		$editeur = new Editeur();
		if(isset($_POST["id_editeur-".$i]))
		{
			$editeur->setAttr("id_editeur", strip_tags(str_replace("'","\'",$_POST["id_editeur-".$i])));
		}
		$editeur->setAttr("nom_editeur", strip_tags(str_replace("'","\'",$_POST["nom_editeur-".$i])));	
		if (isset($_FILES['logo_editeur-'.$i]) )
				{
					if($_FILES['logo_editeur-'.$i]['name']!='')
					{
						if ($_FILES['logo_editeur-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_editeur-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_editeur-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_editeur-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/editeur/')) 
							{
								mkdir('img/editeur/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/editeur/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_editeur-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_editeur-'.$i]['tmp_name'],$nom);
							$editeur->setAttr('logo_editeur', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($editeur->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('Editeur sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutEdition()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$edition = new Edition();
	if(isset($_POST["id_edition"]))
	{
		$edition->setAttr("id_edition", strip_tags(str_replace("'","\'",$_POST["id_edition"])));
	}
	$edition->setAttr("nom_edition", strip_tags(str_replace("'","\'",$_POST["nom_edition"])));	
	if (isset($_FILES['logo_edition']) )
			{
				if($_FILES['logo_edition']['name']!='')
				{
					if ($_FILES['logo_edition']['error'] > 0)
					{
							switch($_FILES['logo_edition']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_edition']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_edition']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/edition/')) 
						{
							mkdir('img/edition/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/edition/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_edition'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_edition']['tmp_name'],$nom);
						$edition->setAttr('logo_edition', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($edition->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Edition sauvegardée')}); </script>";
	}
}

function ajoutMultiEdition()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_edition-".$i]))
	{
		$edition = new edition();
		if(isset($_POST["id_edition-".$i]))
		{
			$edition->setAttr("id_edition", strip_tags(str_replace("'","\'",$_POST["id_edition-".$i])));
		}
		$edition->setAttr("nom_edition", strip_tags(str_replace("'","\'",$_POST["nom_edition-".$i])));	
		if (isset($_FILES['logo_edition-'.$i]) )
				{
					if($_FILES['logo_edition-'.$i]['name']!='')
					{
						if ($_FILES['logo_edition-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_edition-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_edition-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_edition-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/edition/')) 
							{
								mkdir('img/edition/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/edition/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_edition-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_edition-'.$i]['tmp_name'],$nom);
							$edition->setAttr('logo_edition', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($edition->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible (Edition)')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('edition sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutNomJeu()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$nom_jeu = new Nom_jeu();
	$nom_jeu->setAttr("nom_jeu", strip_tags(str_replace("'","\'",$_POST["nom_jeu"])));
	if($nom_jeu->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Nom de jeu sauvegardée')}); </script>";
	}
}

function ajoutCommande()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$commande = new Commande();
	if(isset($_POST["id_commande"]))
	{
		$commande->setAttr("id_commande", strip_tags(str_replace("'","\'",$_POST["id_commande"])));
	}
	$commande->setAttr("nom_commande", strip_tags(str_replace("'","\'",$_POST["nom_commande"])));	
	if (isset($_FILES['logo_commande']) )
	{
		if($_FILES['logo_commande']['name']!='')
				{
					if ($_FILES['logo_commande']['error'] > 0)
					{
							switch($_FILES['logo_commande']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_commande']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_commande']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/commande/')) 
						{
							mkdir('img/commande/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/commande/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_commande'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_commande']['tmp_name'],$nom);
						$commande->setAttr('logo_commande', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($commande->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>".$return;
	}
	else
	{
		return "<script> $(function(){ alertify.success('Controleur sauvegardée')}); </script>".$return;
	}
}

function ajoutMultiCommande()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_commande-".$i]))
	{
		$commande = new commande();
		if(isset($_POST["id_commande-".$i]))
		{
			$commande->setAttr("id_commande", strip_tags(str_replace("'","\'",$_POST["id_commande-".$i])));
		}
		$commande->setAttr("nom_commande", strip_tags(str_replace("'","\'",$_POST["nom_commande-".$i])));	
		if (isset($_FILES['logo_commande-'.$i]) )
				{
					if($_FILES['logo_commande-'.$i]['name']!='')
					{
						if ($_FILES['logo_commande-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_commande-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_commande-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_commande-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/commande/')) 
							{
								mkdir('img/commande/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/commande/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_commande-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_commande-'.$i]['tmp_name'],$nom);
							$commande->setAttr('logo_commande', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($commande->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('commande sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutPlateforme()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$plateforme = new Plateforme();
	if(isset($_POST["id_plateforme"]))
	{
		$plateforme->setAttr("id_plateforme", strip_tags(str_replace("'","\'",$_POST["id_plateforme"])));
	}
	$plateforme->setAttr("nom_plateforme", strip_tags(str_replace("'","\'",$_POST["nom_plateforme"])));
	$plateforme->setAttr("description_plateforme", strip_tags(str_replace("'","\'",$_POST["description_plateforme"]), "<a><br><img><div><span>"));	
	if (isset($_FILES['logo_plateforme']) )
			{
				if($_FILES['logo_plateforme']['name']!='')
				{
					if ($_FILES['logo_plateforme']['error'] > 0)
					{
							switch($_FILES['logo_plateforme']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_plateforme']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_plateforme']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/plateforme/')) 
						{
							mkdir('img/plateforme/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/plateforme/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_plateforme'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_plateforme']['tmp_name'],$nom);
						$plateforme->setAttr('logo_plateforme', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['nom_editeur'])));
	if(isset($editeur[0])) 
	{
		$plateforme->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
	}
	else 
	{
		$editeur = new Editeur();
		$editeur->setAttr('nom_editeur',strip_tags(str_replace("'","\'",$_POST['nom_editeur'])));
		$editeur->save();
		$_POST['incomplet']=1;
		$_POST['ajout_editeur']=array();
		$_POST['ajout_editeur'][]=$editeur;
		$plateforme->setAttr('id_editeur', $editeur->getAttr('id_editeur')); 
	}
	if($plateforme->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Plateforme sauvegardée')}); </script>";
	}
}

function ajoutMultiPlateforme()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_plateforme-".$i]))
	{
		$plateforme = new plateforme();
		if(isset($_POST["id_plateforme-".$i]))
		{
			$plateforme->setAttr("id_plateforme", strip_tags(str_replace("'","\'",$_POST["id_plateforme-".$i])));
		}
		$plateforme->setAttr("nom_plateforme", strip_tags(str_replace("'","\'",$_POST["nom_plateforme-".$i])));	
		if (isset($_FILES['logo_plateforme-'.$i]) )
				{
					if($_FILES['logo_plateforme-'.$i]['name']!='')
					{
						if ($_FILES['logo_plateforme-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_plateforme-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_plateforme-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_plateforme-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/plateforme/')) 
							{
								mkdir('img/plateforme/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/plateforme/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_plateforme-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_plateforme-'.$i]['tmp_name'],$nom);
							$plateforme->setAttr('logo_plateforme', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($plateforme->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('plateforme sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutGroupe()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$groupe = new Groupe();
		if(isset($_POST["id_groupe"]))
	{
		$groupe->setAttr("id_groupe", strip_tags(str_replace("'","\'",$_POST["id_groupe"])));
	}
	$groupe->setAttr("nom_groupe", strip_tags(str_replace("'","\'",$_POST["nom_groupe"])));	
	if (isset($_FILES['logo_groupe']) )
			{
				if($_FILES['logo_groupe']['name']!='')
				{
					if ($_FILES['logo_groupe']['error'] > 0)
					{
							switch($_FILES['logo_groupe']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_groupe']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_groupe']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/groupe/')) 
						{
							mkdir('img/groupe/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/groupe/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_groupe'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_groupe']['tmp_name'],$nom);
						$groupe->setAttr('logo_groupe', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}	
	$parent = Groupe::findByName(strip_tags(str_replace("'","\'",$_POST['groupe_parent'])));
	if(isset($parent[0])) { $groupe->setAttr('id_groupe_parent', $parent[0]->getAttr('id_groupe')); } else { $groupe->setAttr('id_groupe_parent', 0); }
	if($groupe->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Groupe sauvegardé')}); </script>";
	}
}

function ajoutRegion()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$region = new Region();
	if(isset($_POST["id_region"]))
	{
		$region->setAttr("id_region", strip_tags(str_replace("'","\'",$_POST["id_region"])));
	}
	$region->setAttr("nom_region", strip_tags(str_replace("'","\'",$_POST["nom_region"])));	
	if (isset($_FILES['logo_region']) )
			{
				if($_FILES['logo_region']['name']!='')
				{
					if ($_FILES['logo_region']['error'] > 0)
					{
							switch($_FILES['logo_region']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_region']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_region']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/region/')) 
						{
							mkdir('img/region/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/region/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_region'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_region']['tmp_name'],$nom);
						$region->setAttr('logo_region', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}	
	if($region->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Region sauvegardée')}); </script>";
	}
}

function ajoutMultiRegion()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$i=1;
	while(isset($_POST["nom_region-".$i]))
	{
		$region = new region();
		if(isset($_POST["id_region-".$i]))
		{
			$region->setAttr("id_region", strip_tags(str_replace("'","\'",$_POST["id_region-".$i])));
		}
		$region->setAttr("nom_region", strip_tags(str_replace("'","\'",$_POST["nom_region-".$i])));	
		if (isset($_FILES['logo_region-'.$i]) )
				{
					if($_FILES['logo_region-'.$i]['name']!='')
					{
						if ($_FILES['logo_region-'.$i]['error'] > 0)
						{
							switch($_FILES['logo_region-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
						}
						elseif ($_FILES['logo_region-'.$i]['size'] > 1048576)
						{
							$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
						}
						elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_region-'.$i]['name'],'.') ,1)), $formats))
						{
							$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
						}
						else
						{
							if (!is_dir('img/region/')) 
							{
								mkdir('img/region/');
							}
							$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
							$nom = 'img/region/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_region-'.$i])))).'.png';
							$resultat = move_uploaded_file($_FILES['logo_region-'.$i]['tmp_name'],$nom);
							$region->setAttr('logo_region', $nom);
							if($resultat)
							{
								$return= $return. "<script> $(function(){ alertify.success('Photo sauvegardée')}); </script>";
							}
							else
							{
								$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
							}
						}
					}
				}
		if($region->save()==0)
		{
			$return=$return. "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return=$return. "<script> $(function(){ alertify.success('region sauvegardé')}); </script>";
		}
		$i++;
	}
	return $return;
}

function ajoutTypeJeu()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$type_jeu = new Type_jeu();
	if(isset($_POST["id_type_jeu"]))
	{
		$type_jeu->setAttr("id_type_jeu", strip_tags(str_replace("'","\'",$_POST["id_type_jeu"])));
	}
	$type_jeu->setAttr("nom_type_jeu", strip_tags(str_replace("'","\'",$_POST["nom_type_jeu"])));	
	if (isset($_FILES['logo_type_jeu']) )
			{
				if($_FILES['logo_type_jeu']['name']!='')
				{
					if ($_FILES['logo_type_jeu']['error'] > 0)
					{
							switch($_FILES['logo_type_jeu']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_type_jeu']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_type_jeu']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/type_jeu/')) 
						{
							mkdir('img/type_jeu/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/type_jeu/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_type_jeu'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_type_jeu']['tmp_name'],$nom);
						$type_jeu->setAttr('logo_type_jeu', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($type_jeu->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Type de jeu sauvegardé')}); </script>";
	}
}

function ajoutTypeAccessoire()
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$type_accessoire = new Type_Accessoire();
	if(isset($_POST["id_type_accessoire"]))
	{
		$type_accessoire->setAttr("id_type_accessoire", strip_tags(str_replace("'","\'",$_POST["id_type_accessoire"])));
	}
	$type_accessoire->setAttr("nom_type_accessoire", strip_tags(str_replace("'","\'",$_POST["nom_type_accessoire"])));	
	if (isset($_FILES['logo_type_accessoire']) )
			{
				if($_FILES['logo_type_accessoire']['name']!='')
				{
					if ($_FILES['logo_type_accessoire']['error'] > 0)
					{
							switch($_FILES['logo_type_accessoire']['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['logo_type_accessoire']['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['logo_type_accessoire']['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/type_accessoire/')) 
						{
							mkdir('img/type_accessoire/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/type_accessoire/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_type_accessoire'])))).'.png';
						$resultat = move_uploaded_file($_FILES['logo_type_accessoire']['tmp_name'],$nom);
						$type_accessoire->setAttr('logo_type_accessoire', $nom);
						if($resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Photo sauvegardée')}); </script>";
						}
						else
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
	if($type_accessoire->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Type d\'accessoire sauvegardé')}); </script>";
	}
}

function ajoutConsole($user)
{
	$modifs = 1;
	if (!is_dir('img/consoles/')) 
	{
		mkdir('img/consoles/');
	}
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$console = null;
	$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_developpeur']=0;
	$console = new Console();
	$console->setAttr('nom_console', strip_tags(str_replace("'","\'",$_POST['nom_console']))); 
	$console->setAttr('remarque_console', strip_tags(str_replace("'","\'",$_POST['remarque_console']))); 
	if(isset($_POST['id_console']))
	{
		$console->setAttr('id_console', strip_tags(str_replace("'","\'",$_POST['id_console']))); 
	}
	if($_POST['plateforme']=='')
	{
		$console->setAttr('id_plateforme', 0); 
	}
	else
	{
		$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
		if(isset($plateforme[0])) 
		{ 
			$console->setAttr('id_plateforme', $plateforme[0]->getAttr('id_plateforme')); 
		} 
		else 
		{ 
			$plateforme = new Plateforme();
			$plateforme->setAttr('nom_plateforme',$_POST['plateforme']);
			$plateforme->save();
			$_POST['incomplet']=1;
			$_POST['ajout_plateforme'][]=$plateforme;
			$console->setAttr('id_plateforme', $plateforme->getAttr('id_plateforme')); 
		}
	}
	if($_POST['editeur']=='')
	{
		$console->setAttr('id_editeur', 0); 
	}
	else
	{
		$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['editeur'])));
		if(isset($editeur[0])) 
		{ 
			$console->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
		} 
		else 
		{
			$editeur = new Editeur();
			$editeur->setAttr('nom_editeur',$_POST['editeur']);
			$editeur->save();
			$_POST['incomplet']=1;
			$_POST['ajout_editeur']=$editeur->getAttr('id_editeur');
			$console->setAttr('id_editeur', $editeur->getAttr('id_editeur')); 
		}
	}
	if($console->save()!=0)
	{
		$return= "<script> $(function(){ alertify.success('Console sauvegardé')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					if(isset($_POST['id_console']))
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,1,0,0,0,0,0,0,0,0,0,0) on duplicate key UPDATE modifs_consoles = modifs_consoles+1';
					}
					else
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,1,0,0,0,0,0,0,0) on duplicate key UPDATE ajouts_consoles = ajouts_consoles+1';
					}
					$db->query($query);
				}
	}
	if($console->getAttr('id_console')!=0)
	{
		Console_Inclus_Accessoire::deleteByIdConsole($console->getAttr('id_console'));
		Console_Inclus_Jeu::deleteByIdConsole($console->getAttr('id_console'));
		$j=1;
		while(isset($_POST['accessoire-'.$j]))
		{
			if($_POST['accessoire-'.$j]!='')
			{
				$nom = strip_tags(str_replace("'","\'",$_POST['accessoire-'.$j]));
				$p=Plateforme::findById($console->getAttr('id_plateforme'));
				if(isset($p))
				{
					$plateforme = " (".$p->getAttr('nom_plateforme').")";
					if(strpos($nom,$plateforme)!=null)
					{
						$nom = substr($nom,0,strpos($nom,$plateforme));
						$console_inclus_accessoire = new Console_Inclus_Accessoire();
						$accessoire = Accessoire::findByNameAndPlat($nom, $console->getAttr('id_plateforme'));
						if(isset($accessoire[0])) 
						{ 
							$console_inclus_accessoire->setAttr('id_accessoire', $accessoire[0]->getAttr('id_accessoire')); 
							$console_inclus_accessoire->setAttr("id_console",$console->getAttr('id_console'));
							$modifs+=$console_inclus_accessoire->save();
						} 
						else
						{
							$return= $return."<script> $(function(){ alertify.error('Accessoire inexistant')}); </script>";
						}
					}
					else
					{
						$return= $return."<script> $(function(){ alertify.error('Les deux plateformes doivent être identiques (Console et Accessoire)')}); </script>";
					}
				}
				else
				{
					$return= $return."<script> $(function(){ alertify.error('Plateforme de la console inconnue. Ajout accessoire impossible')}); </script>";
				}
			}
			$j++;
		}
		$j=1;
		while(isset($_POST['jeu-'.$j]))
		{
			if($_POST['jeu-'.$j]!='')
			{
				$nom = strip_tags(str_replace("'","\'",$_POST['jeu-'.$j]));
				$p=Plateforme::findById($console->getAttr('id_plateforme'));
				if(isset($p))
				{
					$plateforme = " (".$p->getAttr('nom_plateforme').")";
					if(strpos($nom,$plateforme)!=null)
					{
						$nom = substr($nom,0,strpos($nom,$plateforme));
						$console_inclus_jeu = new Console_Inclus_Jeu();
						$jeux = Jeu::findByKeys($nom, $p->getAttr('nom_plateforme'));
						if(isset($jeux[0])) 
						{ 
							$console_inclus_jeu->setAttr('id_jeu', $jeux[0]); 
							$console_inclus_jeu->setAttr("id_console",$console->getAttr('id_console'));
							$console_inclus_jeu->save();
						} 
						else
						{
							$return= $return."<script> $(function(){ alertify.error('Jeu inexistant')}); </script>";
						}
					}
					else
					{
						$return= $return."<script> $(function(){ alertify.error('Les deux plateformes doivent être identiques (Jeu et Console)')}); </script>";
					}
				}
				else
				{
					$return= $return."<script> $(function(){ alertify.error('Plateforme de la console inconnue. Ajout jeu impossible')}); </script>";
				}
			}
			$j++;
		}
		$i=1;
		$_POST['ajout_region']=array();
		while(isset($_POST['nom_region-'.$i]))
		{
			$versionconsole = new Version_Console();
			$versionconsole->setAttr('id_console', $console->getAttr('id_console'));
			if(isset($_POST['id_version_console-'.$i]))
			{
				$j=$_POST['id_version_console-'.$i]-1;
				$versionconsole->setAttr('id_version_console', strip_tags(str_replace("'","\'",$_POST['id_version_console-'.$i])));
			}
			else
			{
				$j=Version_Console::countVersions();
			}
			if($_POST['nom_region-'.$i]=='')
			{
				$versionconsole->setAttr('id_region', 0); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$versionconsole->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$versionconsole->setAttr('id_region', $region->getAttr('id_region')); 
				}
			}
			$versionconsole->setAttr('ref_console', strip_tags(str_replace("'","\'",$_POST['reference_console-'.$i])));
			$versionconsole->setAttr('remarque_version_console', strip_tags(str_replace("'","\'",$_POST['remarque_version_console-'.$i])));
			$versionconsole->setAttr('prix_console', strip_tags(str_replace("'","\'",$_POST['prix_console-'.$i])));
			$versionconsole->setAttr('date_sortie_console', strip_tags(str_replace("'","\'",$_POST['date_sortie_console-'.$i])));
			if (isset($_FILES['photo_console-'.$i]) )
			{
				if($_FILES['photo_console-'.$i]['name']!='')
				{
					if ($_FILES['photo_console-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_console-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_console-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_console-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/consoles/'.$accessoire->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/consoles/'.$accessoire->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/consoles/'.$console->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_console'])))).'-'.$j.'.png';
						$resultat = move_uploaded_file($_FILES['photo_console-'.$i]['tmp_name'],$nom);
						$versionaccessoire->setAttr('photo_console', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($versionconsole->save()!=0)
			{
				$return= $return."<script> $(function(){ alertify.success('Version sauvegardée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					if(isset($_POST['id_console']))
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,0,0,0,1,0) on duplicate key UPDATE modifs_versions_consoles = modifs_versions_consoles+1';
					}
					else
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,1,0,0,0,0) on duplicate key UPDATE ajouts_versions_consoles = ajouts_versions_consoles+1';
					}
					$db->query($query);
				}
			}
			$i++;
		}	
		if($i==1 && !isset($_POST['id_console']))
		{
			$versionconsole = new Version_console();
			$versionconsole->setAttr('id_console', $jeu->getAttr('id_console'));
			$versionconsole->save();
		}
	}
	return $return;
}

function ajoutVersionConsole($user)
{
	$console=Console::findById(strip_tags(str_replace("'","\'",$_POST['id_console'])));
	if($console!=null)
	{
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_developpeur']=0;
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	if (!is_dir('img/consoles/')) 
	{
		mkdir('img/consoles/');
	}
			$i=1;
			$_POST['ajout_region']=array();
			$versionconsole = new Version_Console();
			$versionconsole->setAttr('id_console', strip_tags(str_replace("'","\'",$_POST['id_console'])));
			if($_POST['nom_region-'.$i]=='')
			{
				$versionconsole->setAttr('id_region', 0); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$versionconsole->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$versionconsole->setAttr('id_region', $region->getAttr('id_region')); 
				}
			}
			$versionconsole->setAttr('ref_console', strip_tags(str_replace("'","\'",$_POST['reference_console-'.$i])));
			$versionconsole->setAttr('remarque_version_console', strip_tags(str_replace("'","\'",$_POST['remarque_version_console-'.$i])));
			$versionconsole->setAttr('prix_console', strip_tags(str_replace("'","\'",$_POST['prix_console-'.$i])));
			$versionconsole->setAttr('date_sortie_console', strip_tags(str_replace("'","\'",$_POST['date_sortie_console-'.$i])));
			if (isset($_FILES['photo_console-'.$i]) )
			{
				if($_FILES['photo_console-'.$i]['name']!='')
				{
					if ($_FILES['photo_console-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_console-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_console-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_console-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/consoles/'.$console->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/consoles/'.$console->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/consoles/'.$console->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($console->getAttr('nom_console'))))).'-'.Version_Console::countVersions().'.png';
						$resultat = move_uploaded_file($_FILES['photo_console-'.$i]['tmp_name'],$nom);
						$versionconsole->setAttr('photo_console', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($versionconsole->save()==0)
			{
				$return= $return."<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
			}
			else
			{
				$return= $return."<script> $(function(){ alertify.success('Version sauvegardée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,1,0,0,0,0) on duplicate key UPDATE ajouts_versions_consoles = ajouts_versions_consoles+1';
					$db->query($query);
				}
			}
	}
	return $return;
}

function ajoutAccessoire($user)
{
	if (!is_dir('img/accessoires/')) 
	{
		mkdir('img/accessoires/');
	}
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$accessoire = null;
	$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_developpeur']=0;
		$accessoire = new Accessoire();
		$accessoire->setAttr('nom_accessoire', strip_tags(str_replace("'","\'",$_POST['nom_accessoire']))); 
		if(isset($_POST['id_accessoire']))
		{
			$accessoire->setAttr('id_accessoire', strip_tags(str_replace("'","\'",$_POST['id_accessoire']))); 
		}
		if($_POST['plateforme']=='')
		{
			$accessoire->setAttr('id_plateforme', 0); 
		}
		else
		{
			$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
			if(isset($plateforme[0])) 
			{ 
				$accessoire->setAttr('id_plateforme', $plateforme[0]->getAttr('id_plateforme')); 
			} 
			else 
			{ 
				$plateforme = new Plateforme();
				$plateforme->setAttr('nom_plateforme',$_POST['plateforme']);
				$plateforme->save();
				$_POST['incomplet']=1;
				$_POST['ajout_plateforme'][]=$plateforme;
				$accessoire->setAttr('id_plateforme', $plateforme->getAttr('id_plateforme')); 
			}
		}
		if($_POST['type_accessoire']=='')
		{
			$accessoire->setAttr('id_type_accessoire', 0); 
		}
		else
		{
			$type_accessoire = Type_accessoire::findByName(strip_tags(str_replace("'","\'",$_POST['type_accessoire'])));
			if(isset($type_accessoire[0])) 
			{ 
				$accessoire->setAttr('id_type_accessoire', $type_accessoire[0]->getAttr('id_type_accessoire')); 
			} 
			else 
			{ 
				$type_accessoire = new Type_accessoire();
				$type_accessoire->setAttr('nom_type_accessoire',$_POST['type_accessoire']);
				$type_accessoire->save();
				$_POST['incomplet']=1;
				$_POST['ajout_type_accessoire']=$type_accessoire->getAttr('id_type_accessoire');
				$accessoire->setAttr('id_type_accessoire', $type_accessoire->getAttr('id_type_accessoire')); 
			}
		}
		if($_POST['editeur']=='')
		{
			$accessoire->setAttr('id_editeur', 0); 
		}
		else
		{
			$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['editeur'])));
			if(isset($editeur[0])) 
			{ 
				$accessoire->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
			} 
			else 
			{
				$editeur = new Editeur();
				$editeur->setAttr('nom_editeur',$_POST['editeur']);
				$editeur->save();
				$_POST['incomplet']=1;
				$_POST['ajout_editeur']=$editeur->getAttr('id_editeur');
				$accessoire->setAttr('id_editeur', $editeur->getAttr('id_editeur')); 
			}
		}
		$accessoire->setAttr('zone', strip_tags(str_replace("'","\'",$_POST['zone'])));
		$accessoire->setAttr('remarque_accessoire', strip_tags(str_replace("'","\'",$_POST['remarque_accessoire'])));
		if($accessoire->save()!=0)
		{
			$return= "<script> $(function(){ alertify.success('Accessoire sauvegardé')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					if(isset($_POST['id_accessoire']))
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,1,0,0,0,0,0,0,0,0,0) on duplicate key UPDATE modifs_accessoires = modifs_accessoires+1';
					}
					else
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,1,0,0,0,0,0,0) on duplicate key UPDATE ajouts_accessoires = ajouts_accessoires+1';
					}
					$db->query($query);
				}
		}

	$i=1;
	$_POST['ajout_region']=array();
		while(isset($_POST['nom_region-'.$i]))
		{
			$versionaccessoire = new Version_Accessoire();
			$versionaccessoire->setAttr('id_accessoire', $accessoire->getAttr('id_accessoire'));
			if(isset($_POST['id_version_accessoire-'.$i]))
			{
				$j=$_POST['id_version_accessoire-'.$i];
				$versionaccessoire->setAttr('id_version_accessoire', strip_tags(str_replace("'","\'",$_POST['id_version_accessoire-'.$i])));
			}
			else
			{
				$j=Version_Accessoire::countVersions();
			}
			if($_POST['nom_region-'.$i]=='')
			{
				$versionaccessoire->setAttr('id_region', 0); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$versionaccessoire->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$versionaccessoire->setAttr('id_region', $region->getAttr('id_region')); 
				}
			}
			$versionaccessoire->setAttr('ref_accessoire', strip_tags(str_replace("'","\'",$_POST['reference_accessoire-'.$i])));
			$versionaccessoire->setAttr('remarque_version_accessoire', strip_tags(str_replace("'","\'",$_POST['remarque_version_accessoire-'.$i])));
			$versionaccessoire->setAttr('prix_accessoire', strip_tags(str_replace("'","\'",$_POST['prix_accessoire-'.$i])));
			$versionaccessoire->setAttr('date_sortie_accessoire', strip_tags(str_replace("'","\'",$_POST['date_sortie_accessoire-'.$i])));
			if (isset($_FILES['photo_accessoire-'.$i]) )
			{
				if($_FILES['photo_accessoire-'.$i]['name']!='')
				{
					if ($_FILES['photo_accessoire-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_accessoire-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_accessoire-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_accessoire-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/accessoires/'.$accessoire->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/accessoires/'.$accessoire->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/accessoires/'.$accessoire->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_accessoire'])))).'-'.$j.'.png';
						$resultat = move_uploaded_file($_FILES['photo_accessoire-'.$i]['tmp_name'],$nom);
						$versionaccessoire->setAttr('photo_accessoire', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($versionaccessoire->save()!=0)
			{
				$return= $return."<script> $(function(){ alertify.success('Version sauvegardée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					if(isset($_POST['id_accessoire']))
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,0,0,0,0,1) on duplicate key UPDATE modifs_versions_accessoires = modifs_versions_accessoires+1';
					}
					else
					{
						$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,0,1,0,0,0) on duplicate key UPDATE ajouts_versions_accessoires = ajouts_versions_accessoires+1';
					}
					$db->query($query);
				}
			}
			$i++;
		}
		
		if($i==1 && !isset($_POST['id_accessoire']))
		{
			$versionaccessoire = new Version_accessoire();
			$versionaccessoire->setAttr('id_accessoire', $jeu->getAttr('id_accessoire'));
			$versionaccessoire->save();
		}
	return $return;
}

function ajoutVersionAccessoire($user)
{
	$accessoire= Accessoire::findById(strip_tags(str_replace("'","\'",$_POST['id_accessoire'])));
	if($accessoire!=null)
	{
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_developpeur']=0;
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	if (!is_dir('img/accessoires/')) 
	{
		mkdir('img/accessoires/');
	}
			$i=1;
			$_POST['ajout_region']=array();
			$versionaccessoire = new Version_Accessoire();
			$versionaccessoire->setAttr('id_accessoire', strip_tags(str_replace("'","\'",$_POST['id_accessoire'])));
			if($_POST['nom_region-'.$i]=='')
			{
				$versionaccessoire->setAttr('id_region', 0); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$versionaccessoire->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$versionaccessoire->setAttr('id_region', $region->getAttr('id_region')); 
				}
			}
			$versionaccessoire->setAttr('remarque_version_accessoire', strip_tags(str_replace("'","\'",$_POST['remarque_version_accessoire-'.$i])));
			$versionaccessoire->setAttr('ref_accessoire', strip_tags(str_replace("'","\'",$_POST['reference_accessoire-'.$i])));
			$versionaccessoire->setAttr('prix_accessoire', strip_tags(str_replace("'","\'",$_POST['prix_accessoire-'.$i])));
			$versionaccessoire->setAttr('date_sortie_accessoire', strip_tags(str_replace("'","\'",$_POST['date_sortie_accessoire-'.$i])));
			if (isset($_FILES['photo_accessoire-'.$i]) )
			{
				if($_FILES['photo_accessoire-'.$i]['name']!='')
				{
					if ($_FILES['photo_accessoire-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_accessoire-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_accessoire-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_accessoire-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						$accessoire=Accessoire::findById(strip_tags(str_replace("'","\'",$_POST['id_accessoire'])));
						if (!is_dir('img/accessoires/'.$accessoire->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/accessoires/'.$accessoire->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/accessoires/'.$accessoire->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($accessoire->getAttr('nom_accessoire'))))).'-'.Version_Accessoire::countVersions().'.png';
						$resultat = move_uploaded_file($_FILES['photo_accessoire-'.$i]['tmp_name'],$nom);
						$versionaccessoire->setAttr('photo_accessoire', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($versionaccessoire->save()==0)
			{
				$return= $return."<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
			}
			else
			{
				$return= $return."<script> $(function(){ alertify.success('Version sauvegardée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,0,1,0,0,0) on duplicate key UPDATE ajouts_versions_accessoires = ajouts_versions_accessoires+1';
					$db->query($query);
				}
			}
	}
	return $return;
}

function ajoutJeu($user)
{
	if (!is_dir('img/jeux/')) 
	{
		mkdir('img/jeux/');
	}
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$jeu = null;
	$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu'])));
	$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_developpeur']=0;
	if(isset($nom_jeu[0])) 
	{
		if(isset($plateforme[0])) {
			$jeux = Jeu::findDuplicates($nom_jeu[0]->getAttr('id_nom_jeu'), $plateforme[0]->getAttr('id_plateforme'));
		}
		else
		{
			$jeux = array();
		}
		if(isset($jeux[0]))
		$jeu = $jeux[0];
	}
	if($jeu==null)
	{
		$jeu = new Jeu();
		$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu'])));
		if(isset($nom_jeu[0])) 
		{
				$jeu->setAttr('id_nom_jeu', $nom_jeu[0]->getAttr('id_nom_jeu')); 
			} 
		else 
		{
				$nom_jeu = new Nom_jeu();
				$nom_jeu->setAttr('nom_jeu', strip_tags(str_replace("'","\'",$_POST['nom_jeu']))); 
				$jeu->setAttr('id_nom_jeu', $nom_jeu->save());
		}
		if($_POST['plateforme']=='')
		{
			$jeu->setAttr('id_plateforme', 0); 
		}
		else
		{
			$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
			if(isset($plateforme[0])) 
			{ 
				$jeu->setAttr('id_plateforme', $plateforme[0]->getAttr('id_plateforme')); 
			} 
			else 
			{ 
				$plateforme = new Plateforme();
				$plateforme->setAttr('nom_plateforme',$_POST['plateforme']);
				$plateforme->save();
				$_POST['incomplet']=1;
				$_POST['ajout_plateforme'][]=$plateforme;
				$jeu->setAttr('id_plateforme', $plateforme->getAttr('id_plateforme')); 
			}
		}
		if($_POST['type_jeu']=='')
		{
			$jeu->setAttr('id_type_jeu', 0); 
		}
		else
		{
			$type_jeu = Type_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['type_jeu'])));
			if(isset($type_jeu[0])) 
			{ 
				$jeu->setAttr('id_type_jeu', $type_jeu[0]->getAttr('id_type_jeu')); 
			} 
			else 
			{ 
				$type_jeu = new Type_jeu();
				$type_jeu->setAttr('nom_type_jeu',$_POST['type_jeu']);
				$type_jeu->save();
				$_POST['incomplet']=1;
				$_POST['ajout_type']=$type_jeu->getAttr('id_type_jeu');
				$jeu->setAttr('id_type_jeu', $type_jeu->getAttr('id_type_jeu')); 
			}
		}
		if($_POST['groupe_parent']=='')
		{
			$jeu->setAttr('id_groupe', 0); 
		}
		else
		{
			$groupe_parent = Groupe::findByName(strip_tags(str_replace("'","\'",$_POST['groupe_parent'])));
			if(isset($groupe_parent[0])) 
			{ 
				$jeu->setAttr('id_groupe', $groupe_parent[0]->getAttr('id_groupe')); 
			} 
			else 
			{
				$groupe_parent = new Groupe();
				$groupe_parent->setAttr('nom_groupe',$_POST['groupe_parent']);
				$groupe_parent->save();
				$_POST['incomplet']=1;
				$_POST['ajout_groupe']=$groupe_parent->getAttr('id_groupe');
				$jeu->setAttr('id_groupe', $groupe_parent->getAttr('id_groupe')); 
			}
		}
		if($_POST['developpeur']=='')
		{
			$jeu->setAttr('id_developpeur', 0); 
		}
		else
		{
			$developpeur = Developpeur::findByName(strip_tags(str_replace("'","\'",$_POST['developpeur'])));
			if(isset($developpeur[0])) 
			{ 
				$jeu->setAttr('id_developpeur', $developpeur[0]->getAttr('id_developpeur')); 
			} 
			else 
			{
				$developpeur = new Developpeur();
				$developpeur->setAttr('nom_developpeur',$_POST['developpeur']);
				$developpeur->save();
				$_POST['incomplet']=1;
				$_POST['ajout_developpeur']=$developpeur->getAttr('id_developpeur');
				$jeu->setAttr('id_developpeur', $developpeur->getAttr('id_developpeur')); 
			}
		}
		$jeu->setAttr('nombre_joueurs', strip_tags(str_replace("'","\'",$_POST['nombre_joueurs'])));
		$jeu->setAttr('jeu_valide', strip_tags(str_replace("'","\'",$_POST['jeu_valide'])));
		$jeu->setAttr('remarque_jeu', strip_tags(str_replace("'","\'",$_POST['remarque_jeu'])));
		if($jeu->save()==0)
		{
			$return= "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
		}
		else
		{
			$return= "<script> $(function(){ alertify.success('Jeu sauvegardé')}); </script>";
			if($user->data['user_id']!=1)
			{
				$db = Base::getConnection();
				$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,1,0,0,0,0,0,0,0,0) on duplicate key UPDATE ajouts_jeux = ajouts_jeux+1';
				$db->query($query);
			}
		}
	}
	else
	{
		$return= "<script> $(function(){ alertify.error('Sauvegarde impossible : Jeu déja existant')}); </script>";
	}
	$i=1;
	$_POST['ajout_editeur']=array();
	$_POST['ajout_langue']=array();
	$_POST['ajout_support']=array();
	$_POST['ajout_format']=array();
	$_POST['ajout_region']=array();
	$_POST['ajout_edition']=array();
		while(isset($_POST['nom_edition-'.$i]))
		{
			$detailsjeu = new Details_jeu();
			$detailsjeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
			if($_POST['nom_region-'.$i]=='')
			{
				$detailsjeu->setAttr('id_region', 0); 
			}
			else if(isset($_POST['last_region-'.$i]))
			{
				$detailsjeu->setAttr('id_region', $lastregion); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$detailsjeu->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$detailsjeu->setAttr('id_region', $region->getAttr('id_region')); 
				}
				$lastregion = $detailsjeu->getAttr('id_region');
			}
			if($_POST['nom_edition-'.$i]=='')
			{
				$detailsjeu->setAttr('id_edition', 0); 
			}
			else if(isset($_POST['last_edition-'.$i]))
			{
				$detailsjeu->setAttr('id_edition', $lastedition); 
			}
			else
			{
				$edition = Edition::findByName(strip_tags(str_replace("'","\'",$_POST['nom_edition-'.$i])));
				if(isset($edition[0])) 
				{
					$detailsjeu->setAttr('id_edition', $edition[0]->getAttr('id_edition')); 
				}
				else 
				{
					$edition = new Edition();
					$edition->setAttr('nom_edition',$_POST['nom_edition-'.$i]);
					$edition->save();
					$_POST['incomplet']=1;
					$_POST['ajout_edition'][]=$edition;
					$detailsjeu->setAttr('id_edition', $edition->getAttr('id_edition')); 
				}
				$lastedition = $detailsjeu->getAttr('id_edition');
			}
			if($_POST['nom_editeur-'.$i]=='')
			{
				$detailsjeu->setAttr('id_editeur', 0); 
			}
			else if(isset($_POST['last_editeur-'.$i]))
			{
				$detailsjeu->setAttr('id_editeur', $lastediteur); 
			}
			else
			{
				$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['nom_editeur-'.$i])));
				if(isset($editeur[0])) 
				{ 
					$detailsjeu->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
				}
				else
				{ 
					$editeur = new Editeur();
					$editeur->setAttr('nom_editeur',$_POST['nom_editeur-'.$i]);
					$editeur->save();
					$_POST['incomplet']=1;
					$_POST['ajout_editeur'][]=$editeur;
					$detailsjeu->setAttr('id_editeur', $editeur->getAttr('id_editeur')); 
				}
				$lastediteur = $detailsjeu->getAttr('id_editeur');
			}
			if($_POST['nom_support-'.$i]=='')
			{
				$detailsjeu->setAttr('id_support', 0); 
			}
			else if(isset($_POST['last_support-'.$i]))
			{
				$detailsjeu->setAttr('id_support', $lastsupport); 
			}
			else
			{
				$support = Support::findByName(strip_tags(str_replace("'","\'",$_POST['nom_support-'.$i])));
				if(isset($support[0])) 
				{ 
					$detailsjeu->setAttr('id_support', $support[0]->getAttr('id_support')); 
				} 
				else 
				{ 
					$support = new Support();
					$support->setAttr('nom_support',$_POST['nom_support-'.$i]);
					$support->save();
					$_POST['incomplet']=1;
					$_POST['ajout_support'][]=$support;
					$detailsjeu->setAttr('id_support', $support->getAttr('id_support')); 
				}
				$lastsupport = $detailsjeu->getAttr('id_support');
			}
			if($_POST['nom_format-'.$i]=='')
			{
				$detailsjeu->setAttr('id_format', 0); 
			}
			else if(isset($_POST['nom_format-'.$i]))
			{
				$detailsjeu->setAttr('id_format', $lastformat); 
			}
			else
			{
				$format = Format::findByName(strip_tags(str_replace("'","\'",$_POST['nom_format-'.$i])));
				if(isset($format[0])) 
				{ 
					$detailsjeu->setAttr('id_format', $format[0]->getAttr('id_format')); 
				} 
				else 
				{ 
					$format = new Format();
					$format->setAttr('nom_format',$_POST['nom_format-'.$i]);
					$format->save();
					$_POST['incomplet']=1;
					$_POST['ajout_format'][]=$format;
					$detailsjeu->setAttr('id_format', $format->getAttr('id_format')); 
				}
				$lastformat = $detailsjeu->getAttr('id_format');
			}
			$detailsjeu->setAttr('reference_jeu', strip_tags(str_replace("'","\'",$_POST['reference_jeu-'.$i])));
			$lastref = $_POST['reference_jeu-'.$i];
			$detailsjeu->setAttr('code_barre_jeu', strip_tags(str_replace("'","\'",$_POST['code_barre_jeu-'.$i])));
			$lastcode = $_POST['code_barre_jeu-'.$i];
			$detailsjeu->setAttr('version_jeu_valide', strip_tags(str_replace("'","\'",$_POST['version_jeu_valide-'.$i])));
			$detailsjeu->setAttr('date_sortie_jeu', strip_tags(str_replace("'","\'",$_POST['date_sortie_jeu-'.$i])));
			$lastdate = $_POST['date_sortie_jeu-'.$i];
			$detailsjeu->setAttr('remarque_version_jeu', strip_tags(str_replace("'","\'",$_POST['remarque_version_jeu-'.$i])));
			$lastremarque = $_POST['remarque_version_jeu-'.$i];
			if (isset($_FILES['photo_boite-'.$i]) )
			{
				if($_FILES['photo_boite-'.$i]['name']!='')
				{
					if ($_FILES['photo_boite-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_boite-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_boite-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_boite-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.Details_Jeu::countVersions().'_boite.png';
						$resultat = move_uploaded_file($_FILES['photo_boite-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_boite', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_dos_boite-'.$i]) )
			{
				if($_FILES['photo_dos_boite-'.$i]['name']!='')
				{
					if ($_FILES['photo_dos_boite-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_dos_boite-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_dos_boite-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_dos_boite-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.Details_Jeu::countVersions().'_dos_boite.png';
						$resultat = move_uploaded_file($_FILES['photo_dos_boite-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_dos_boite', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_loose-'.$i]) )
			{
				if($_FILES['photo_loose-'.$i]['name']!='')
				{
					if ($_FILES['photo_loose-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_loose-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_loose-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_loose-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.Details_Jeu::countVersions().'_loose.png';
						$resultat = move_uploaded_file($_FILES['photo_loose-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_loose', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_notice-'.$i]) )
			{
				if($_FILES['photo_notice-'.$i]['name']!='')
				{
					if ($_FILES['photo_notice-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_notice-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_notice-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_notice-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.Details_Jeu::countVersions().'_notice.png';
						$resultat = move_uploaded_file($_FILES['photo_notice-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_notice', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($detailsjeu->save()==0)
			{
				$return= $return."<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
			}
			else
			{
				$return= $return."<script> $(function(){ alertify.success('Version sauvegardée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,1,0,0,0,0,0) on duplicate key UPDATE ajouts_versions_jeux = ajouts_versions_jeux+1';
					$db->query($query);
				}
				$j=1;
				$nb=0;
				while(isset($_POST['langue-'.$i.'-'.$j]))
				{
					if($_POST['langue-'.$i.'-'.$j]!='')
					{
						$langue_jeu = new Langue_jeu();
						$langue = Langue::findByName(strip_tags(str_replace("'","\'",$_POST['langue-'.$i.'-'.$j])));
						if(isset($langue[0])) 
						{ 
							$langue_jeu->setAttr('id_langue', $langue[0]->getAttr('id_langue')); 
						} 
						else 
						{ 
							$langue = new Langue();
							$langue->setAttr('nom_langue',$_POST['langue-'.$i.'-'.$j]);
							$langue->save();
							$_POST['incomplet']=1;
							$_POST['ajout_langue'][]=$langue;
							$langue_jeu->setAttr('id_langue', $langue->getAttr('id_langue'));
						}
						$langue_jeu->setAttr("id_jeu",$jeu->getAttr('id_jeu'));
						$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
						$langue_jeu->save();
						$nb++;
					}
					$j++;
				}
				if($nb==0)
				{
						$langue_jeu = new Langue_jeu();
						$langue_jeu->setAttr("id_jeu",$jeu->getAttr('id_jeu'));
						$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
						$langue_jeu->setAttr('id_langue', 0);
						$langue_jeu->save();
				}
				$j=1;
				while(isset($_POST['accessoire-'.$i.'-'.$j]))
				{
					if($_POST['accessoire-'.$i.'-'.$j]!='')
					{
						$nom = strip_tags(str_replace("'","\'",$_POST['accessoire-'.$i.'-'.$j]));
						$plateforme = " (".$_POST['plateforme'].")";
						if(strpos($nom,$plateforme)!=null)
						{
							$nom = substr($nom,0,strpos($nom,$plateforme));
							$jeu_inclus_accessoire = new Jeu_Inclus_Accessoire();
							$accessoire = Accessoire::findByNameAndPlat($nom, $jeu->getAttr('id_plateforme'));
							if(isset($accessoire[0])) 
							{ 
								$jeu_inclus_accessoire->setAttr('id_accessoire', $accessoire[0]->getAttr('id_accessoire')); 
								$jeu_inclus_accessoire->setAttr("id_version",$detailsjeu->getAttr('id_version'));
								$jeu_inclus_accessoire->save();
							} 
							else
							{
								$return= $return."<script> $(function(){ alertify.error('Accessoire inexistant')}); </script>";
							}
						}
						else
						{
							$return= $return."<script> $(function(){ alertify.error('Les deux plateformes doivent être identiques (Jeu et Accessoire)')}); </script>";
						}

					}
					$j++;
				}
				if($_POST['nom_jeu-'.$i]!='')
				{
					$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu-'.$i])));
					$autre_nom_jeu = new Autre_nom_jeu();
					if(isset($nom_jeu[0])) 
					{
						$autre_nom_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
						$autre_nom_jeu->setAttr('id_version', $detailsjeu->getAttr('id_version'));
						$autre_nom_jeu->setAttr('id_nom_jeu', $nom_jeu[0]->getAttr('id_nom_jeu')); 
						$autre_nom_jeu->save();
					} 
					else 
					{
						$nom_jeu = new Nom_jeu();
						$nom_jeu->setAttr('nom_jeu', strip_tags(str_replace("'","\'",$_POST['nom_jeu-'.$i]))); 
						$autre_nom_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
						$autre_nom_jeu->setAttr('id_version', $detailsjeu->getAttr('id_version'));
						$autre_nom_jeu->setAttr('id_nom_jeu', $nom_jeu->save()); 
						$autre_nom_jeu->save();
					}
				}
			}
			$i++;
		}
		
		if($i==1)
		{
			$detailsjeu = new Details_jeu();
			$detailsjeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
			$detailsjeu->save();
			$langue_jeu = new Langue_jeu();
			$langue_jeu->setAttr("id_jeu",$jeu->getAttr('id_jeu'));
			$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
			$langue_jeu->setAttr('id_langue', 0);
			$langue_jeu->save();
		}
		$i=1;
		$nb=0;
		while(isset($_POST['autre_plateforme-'.$i]))
		{
			if($_POST['autre_plateforme-'.$i]!='')
			{
				$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['autre_plateforme-'.$i])));
				if(isset($plateforme[0])) 
				{
					$autre_plateforme_jeu = new Autre_plateforme_jeu();
					$autre_plateforme_jeu->setAttr('id_plateforme', $plateforme[0]->getAttr('id_plateforme')); 
					$autre_plateforme_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$autre_plateforme_jeu->save();
					$nb++;
				} 
				else
				{
					$autre_plateforme_jeu = new Autre_plateforme_jeu();
					$plateforme = new Plateforme();
					$plateforme->setAttr('nom_plateforme',$_POST['autre_plateforme-'.$i]);
					$plateforme->save();
					$_POST['incomplet']=1;
					$_POST['ajout_plateforme'][]=$plateforme;
					$autre_plateforme_jeu->setAttr('id_plateforme', $plateforme->getAttr('id_plateforme')); 
					$autre_plateforme_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$autre_plateforme_jeu->save();
					$nb++;
				}
			}
			$i++;
		}
		if($nb==0)
		{
			$autre_plateforme_jeu = new Autre_plateforme_jeu();
			$autre_plateforme_jeu->setAttr('id_plateforme', 0); 
			$autre_plateforme_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
			$autre_plateforme_jeu->save();
		}
		$i=1;
		$nb=0;
		$_POST['ajout_commande']=array();
		while(isset($_POST['commande-'.$i]))
		{
			if($_POST['commande-'.$i]!='')
			{
				$commande = Commande::findByName(strip_tags(str_replace("'","\'",$_POST['commande-'.$i])));
				if(isset($commande[0])) 
				{
					$commande_jeu = new Commande_jeu();
					$commande_jeu->setAttr('id_commande', $commande[0]->getAttr('id_commande')); 
					$commande_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$commande_jeu->save();
					$nb++;
				} 
				else
				{
					$commande_jeu = new Commande_jeu();
					$commande = new Commande();
					$commande->setAttr('nom_commande',$_POST['commande-'.$i]);
					$commande->save();
					$_POST['incomplet']=1;
					$_POST['ajout_commande'][]=$commande;
					$commande_jeu->setAttr('id_commande', $commande->getAttr('id_commande')); 
					$commande_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$commande_jeu->save();
					$nb++;
				} 
			}
			$i++;
		}
		if($nb==0)
		{
					$commande_jeu = new Commande_jeu();
					$commande_jeu->setAttr('id_commande', 0); 
					$commande_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$commande_jeu->save();
		}
	return $return;
}

function ajoutVersionJeu($user)
{
	
	$jeu = Jeu::findById( strip_tags(str_replace("'","\'",$_POST['id_jeu'])));
	if(!$jeu==null)
	{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	if (!is_dir('img/jeux/')) 
	{
		mkdir('img/jeux/');
	}
	$i=1;
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_editeur']=array();
	$_POST['ajout_langue']=array();
	$_POST['ajout_support']=array();
	$_POST['ajout_format']=array();
	$_POST['ajout_region']=array();
	$_POST['ajout_edition']=array();
	$detailsjeu = new Details_jeu();
	$detailsjeu->setAttr('id_jeu', strip_tags(str_replace("'","\'",$_POST['id_jeu'])));
			if($_POST['nom_region-'.$i]=='')
			{
				$detailsjeu->setAttr('id_region', 0); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$detailsjeu->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$detailsjeu->setAttr('id_region', $region->getAttr('id_region')); 
				}
			}
			if($_POST['nom_edition-'.$i]=='')
			{
				$detailsjeu->setAttr('id_edition', 0); 
			}
			else
			{
				$edition = Edition::findByName(strip_tags(str_replace("'","\'",$_POST['nom_edition-'.$i])));
				if(isset($edition[0])) 
				{
				$detailsjeu->setAttr('id_edition', $edition[0]->getAttr('id_edition')); 
				}
				else 
				{
					$edition = new Edition();
					$edition->setAttr('nom_edition',$_POST['nom_edition-'.$i]);
					$edition->save();
					$_POST['incomplet']=1;
					$_POST['ajout_edition'][]=$edition;
					$detailsjeu->setAttr('id_edition', $edition->getAttr('id_edition')); 
				}
			}
			if($_POST['nom_editeur-'.$i]=='')
			{
				$detailsjeu->setAttr('id_editeur', 0); 
			}
			else
			{
				$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['nom_editeur-'.$i])));
				if(isset($editeur[0])) 
				{ 
					$detailsjeu->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
				}
				else
				{ 
					$editeur = new Editeur();
					$editeur->setAttr('nom_editeur',$_POST['nom_editeur-'.$i]);
					$editeur->save();
					$_POST['incomplet']=1;
					$_POST['ajout_editeur'][]=$editeur;
					$detailsjeu->setAttr('id_editeur', $editeur->getAttr('id_editeur')); 
				}
			}
			if($_POST['nom_support-'.$i]=='')
			{
				$detailsjeu->setAttr('id_support', 0); 
			}
			else
			{
				$support = Support::findByName(strip_tags(str_replace("'","\'",$_POST['nom_support-'.$i])));
				if(isset($support[0])) 
				{ 
					$detailsjeu->setAttr('id_support', $support[0]->getAttr('id_support')); 
				} 
				else 
				{ 
					$support = new Support();
					$support->setAttr('nom_support',$_POST['nom_support-'.$i]);
					$support->save();
					$_POST['incomplet']=1;
					$_POST['ajout_support'][]=$support;
					$detailsjeu->setAttr('id_support', $support->getAttr('id_support')); 
				}
			}
			if($_POST['nom_format-'.$i]=='')
			{
				$detailsjeu->setAttr('id_format', 0); 
			}
			else
			{
				$format = Format::findByName(strip_tags(str_replace("'","\'",$_POST['nom_format-'.$i])));
				if(isset($format[0])) 
				{ 
					$detailsjeu->setAttr('id_format', $format[0]->getAttr('id_format')); 
				} 
				else 
				{ 
					$format = new Format();
					$format->setAttr('nom_format',$_POST['nom_format-'.$i]);
					$format->save();
					$_POST['incomplet']=1;
					$_POST['ajout_format'][]=$format;
					$detailsjeu->setAttr('id_format', $format->getAttr('id_format')); 
				}
			}
			$detailsjeu->setAttr('reference_jeu', strip_tags(str_replace("'","\'",$_POST['reference_jeu-'.$i])));
			$detailsjeu->setAttr('code_barre_jeu', strip_tags(str_replace("'","\'",$_POST['code_barre_jeu-'.$i])));
			$detailsjeu->setAttr('version_jeu_valide', strip_tags(str_replace("'","\'",$_POST['version_jeu_valide-'.$i])));
			$detailsjeu->setAttr('date_sortie_jeu', strip_tags(str_replace("'","\'",$_POST['date_sortie_jeu-'.$i])));
			$detailsjeu->setAttr('remarque_version_jeu', strip_tags(str_replace("'","\'",$_POST['remarque_version_jeu-'.$i])));
			$jeu=Jeu::findById(strip_tags(str_replace("'","\'",$_POST['id_jeu'])));
			$nomJeu = Nom_Jeu::findById($jeu->getAttr('id_nom_jeu'));
			if (isset($_FILES['photo_boite-'.$i]) )
			{
				if($_FILES['photo_boite-'.$i]['name']!='')
				{
					if ($_FILES['photo_boite-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_boite-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_boite-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_boite-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($nomJeu->getAttr('nom_jeu'))))).'-'.Details_Jeu::countVersions().'_boite.png';
						$resultat = move_uploaded_file($_FILES['photo_boite-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_boite', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_dos_boite-'.$i]) )
			{
				if($_FILES['photo_dos_boite-'.$i]['name']!='')
				{
					if ($_FILES['photo_dos_boite-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_dos_boite-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_dos_boite-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_dos_boite-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($nomJeu->getAttr('nom_jeu'))))).'-'.Details_Jeu::countVersions().'_dos_boite.png';
						$resultat = move_uploaded_file($_FILES['photo_dos_boite-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_dos_boite', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_loose-'.$i]) )
			{
				if($_FILES['photo_loose-'.$i]['name']!='')
				{
					if ($_FILES['photo_loose-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_loose-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_loose-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_loose-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($nomJeu->getAttr('nom_jeu'))))).'-'.Details_Jeu::countVersions().'_loose.png';
						$resultat = move_uploaded_file($_FILES['photo_loose-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_loose', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_notice-'.$i]) )
			{
				if($_FILES['photo_notice-'.$i]['name']!='')
				{
					if ($_FILES['photo_notice-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_notice-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_notice-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_notice-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($nomJeu->getAttr('nom_jeu'))))).'-'.Details_Jeu::countVersions().'_notice.png';
						$resultat = move_uploaded_file($_FILES['photo_notice-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_notice', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($detailsjeu->save()==0)
			{
				$return= $return."<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
			}
			else
			{
				$return= $return."<script> $(function(){ alertify.success('Version sauvegardée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,1,0,0,0,0,0) on duplicate key UPDATE ajouts_versions_jeux = ajouts_versions_jeux+1';
					$db->query($query);
				}
				$j=1;
				$nb=0;
				while(isset($_POST['langue-'.$i.'-'.$j]))
				{
					if($_POST['langue-'.$i.'-'.$j]!='')
					{
						$langue_jeu = new Langue_jeu();
						$langue = Langue::findByName(strip_tags(str_replace("'","\'",$_POST['langue-'.$i.'-'.$j])));
						if(isset($langue[0])) 
						{ 
							$langue_jeu->setAttr('id_langue', $langue[0]->getAttr('id_langue')); 
						} 
						else 
						{ 
							$langue = new Langue();
							$langue->setAttr('nom_langue',$_POST['langue-'.$i.'-'.$j]);
							$langue->save();
							$_POST['incomplet']=1;
							$_POST['ajout_langue'][]=$langue;
							$langue_jeu->setAttr('id_langue', $langue->getAttr('id_langue'));
						}
						$langue_jeu->setAttr("id_jeu",$_POST['id_jeu']);
						$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
						$langue_jeu->save();
						$nb++;
					}
					$j++;
				}
				$j=1;
				while(isset($_POST['accessoire-'.$i.'-'.$j]))
				{
					if($_POST['accessoire-'.$i.'-'.$j]!='')
					{
						$nom = strip_tags(str_replace("'","\'",$_POST['accessoire-'.$i.'-'.$j]));
						$p=Plateforme::findById($jeu->getAttr('id_plateforme'));
						if(isset($p))
						{
							$plateforme = " (".$p->getAttr('nom_plateforme').")";
							if(strpos($nom,$plateforme)!=null)
							{
								$nom = substr($nom,0,strpos($nom,$plateforme));
								$jeu_inclus_accessoire = new Jeu_Inclus_Accessoire();
								$accessoire = Accessoire::findByNameAndPlat($nom, $jeu->getAttr('id_plateforme'));
								if(isset($accessoire[0])) 
								{ 
									$jeu_inclus_accessoire->setAttr('id_accessoire', $accessoire[0]->getAttr('id_accessoire')); 
									$jeu_inclus_accessoire->setAttr("id_version",$detailsjeu->getAttr('id_version'));
									$jeu_inclus_accessoire->save();
								} 
								else
								{
									$return= $return."<script> $(function(){ alertify.error('Accessoire inexistant')}); </script>";
								}
							}
							else
							{
								$return= $return."<script> $(function(){ alertify.error('Les deux plateformes doivent être identiques (Jeu et Accessoire)')}); </script>";
							}
						}
						else
						{
							$return= $return."<script> $(function(){ alertify.error('Plateforme du jeu inconnue. Ajout accessoire impossible')}); </script>";
						}

					}
					$j++;
				}
				if($nb==0)
				{
						$langue_jeu = new Langue_jeu();
						$langue_jeu->setAttr("id_jeu",$_POST['id_jeu']);
						$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
						$langue_jeu->setAttr('id_langue', 0);
						$langue_jeu->save();
				}
				if($_POST['nom_jeu-'.$i]!='')
				{
					$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu-'.$i])));
					$autre_nom_jeu = new Autre_nom_jeu();
					if(isset($nom_jeu[0])) 
					{
						$autre_nom_jeu->setAttr('id_jeu', $_POST['id_jeu']);
						$autre_nom_jeu->setAttr('id_version', $detailsjeu->getAttr('id_version'));
						$autre_nom_jeu->setAttr('id_nom_jeu', $nom_jeu[0]->getAttr('id_nom_jeu')); 
						$autre_nom_jeu->save();
					} 
					else 
					{
						$nom_jeu = new Nom_jeu();
						$nom_jeu->setAttr('nom_jeu', strip_tags(str_replace("'","\'",$_POST['nom_jeu-'.$i]))); 
						$autre_nom_jeu->setAttr('id_jeu', $_POST['id_jeu']);
						$autre_nom_jeu->setAttr('id_version', $detailsjeu->getAttr('id_version'));
						$autre_nom_jeu->setAttr('id_nom_jeu', $nom_jeu->save()); 
						$autre_nom_jeu->save();
					}
				}
			}
	}
	return $return;
}

function modifJeu($user)
{
	$formats = array('png','bmp','gif','jpg','jpeg','tif'); 
	$jeu = Jeu::findById($_POST['id_jeu']);
	$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu'])));
	$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
	$_POST['ajout_plateforme']=array();
	$_POST['ajout_developpeur']=0;
	if(isset($nom_jeu[0])) 
	{
		if(isset($plateforme[0])) {
			$jeux = Jeu::findDuplicates($nom_jeu[0]->getAttr('id_nom_jeu'), $plateforme[0]->getAttr('id_plateforme'));
		}
		else
		{
			$jeux = array();
		}
		if(isset($jeux[0]))
		$jeu = $jeux[0];
	}
		$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu'])));
		if(isset($nom_jeu[0])) 
		{
				$jeu->setAttr('id_nom_jeu', $nom_jeu[0]->getAttr('id_nom_jeu')); 
		} 
		else 
		{
				$nom_jeu = new Nom_jeu();
				$nom_jeu->setAttr('nom_jeu', strip_tags(str_replace("'","\'",$_POST['nom_jeu']))); 
				$jeu->setAttr('id_nom_jeu', $nom_jeu->save());
		}
		if($_POST['plateforme']=='')
		{
			$jeu->setAttr('id_plateforme', 0); 
		}
		else
		{
			$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['plateforme'])));
			if(isset($plateforme[0])) 
			{ 
				$jeu->setAttr('id_plateforme', $plateforme[0]->getAttr('id_plateforme')); 
			} 
			else 
			{ 
				$plateforme = new Plateforme();
				$plateforme->setAttr('nom_plateforme',$_POST['plateforme']);
				$plateforme->save();
				$_POST['incomplet']=1;
				$_POST['ajout_plateforme'][]=$plateforme;
				$jeu->setAttr('id_plateforme', $plateforme->getAttr('id_plateforme')); 
			}
		}
		if($_POST['type_jeu']=='')
		{
			$jeu->setAttr('id_type_jeu', 0); 
		}
		else
		{
			$type_jeu = Type_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['type_jeu'])));
			if(isset($type_jeu[0])) 
			{ 
				$jeu->setAttr('id_type_jeu', $type_jeu[0]->getAttr('id_type_jeu')); 
			} 
			else 
			{ 
				$type_jeu = new Type_jeu();
				$type_jeu->setAttr('nom_type_jeu',$_POST['type_jeu']);
				$type_jeu->save();
				$_POST['incomplet']=1;
				$_POST['ajout_type']=$type_jeu->getAttr('id_type_jeu');
				$jeu->setAttr('id_type_jeu', $type_jeu->getAttr('id_type_jeu')); 
			}
		}
		if($_POST['groupe_parent']=='')
		{
			$jeu->setAttr('id_groupe', 0); 
		}
		else
		{
			$groupe_parent = Groupe::findByName(strip_tags(str_replace("'","\'",$_POST['groupe_parent'])));
			if(isset($groupe_parent[0])) 
			{ 
				$jeu->setAttr('id_groupe', $groupe_parent[0]->getAttr('id_groupe')); 
			} 
			else 
			{
				$groupe_parent = new Groupe();
				$groupe_parent->setAttr('nom_groupe',$_POST['groupe_parent']);
				$groupe_parent->save();
				$_POST['incomplet']=1;
				$_POST['ajout_groupe']=$groupe_parent->getAttr('id_groupe');
				$jeu->setAttr('id_groupe', $groupe_parent->getAttr('id_groupe')); 
			}
		}
		if($_POST['developpeur']=='')
		{
			$jeu->setAttr('id_developpeur', 0); 
		}
		else
		{
			$developpeur = Developpeur::findByName(strip_tags(str_replace("'","\'",$_POST['developpeur'])));
			if(isset($developpeur[0])) 
			{ 
				$jeu->setAttr('id_developpeur', $developpeur[0]->getAttr('id_developpeur')); 
			} 
			else 
			{
				$developpeur = new Developpeur();
				$developpeur->setAttr('nom_developpeur',$_POST['developpeur']);
				$developpeur->save();
				$_POST['incomplet']=1;
				$_POST['ajout_developpeur']=$developpeur->getAttr('id_developpeur');
				$jeu->setAttr('id_developpeur', $developpeur->getAttr('id_developpeur')); 
			}
		}
		$jeu->setAttr('nombre_joueurs', strip_tags(str_replace("'","\'",$_POST['nombre_joueurs'])));
		$jeu->setAttr('jeu_valide', strip_tags(str_replace("'","\'",$_POST['jeu_valide'])));
		$jeu->setAttr('remarque_jeu', strip_tags(str_replace("'","\'",$_POST['remarque_jeu'])));
		$i=1;
		while(isset($_POST['nom_edition-'.$i]))
		{
			$detailsjeu = new Details_jeu();
			$detailsjeu->setAttr('id_jeu', $_POST['id_jeu']);
			if(isset($_POST['id_version-'.$i]))
			{
				$detailsjeu->setAttr('id_version', $_POST['id_version-'.$i]);
				$j = $_POST['id_version-'.$i]-1;
			}
			else
			{
				$j = Details_Jeu::countVersions();
			}
			if($_POST['nom_region-'.$i]=='')
			{
				$detailsjeu->setAttr('id_region', 0); 
			}
			else
			{
				$region = Region::findByName(strip_tags(str_replace("'","\'",$_POST['nom_region-'.$i])));
				if(isset($region[0])) 
				{
					$detailsjeu->setAttr('id_region', $region[0]->getAttr('id_region')); 
				} 
				else 
				{ 
					$region = new Region();
					$region->setAttr('nom_region',$_POST['nom_region-'.$i]);
					$region->save();
					$_POST['incomplet']=1;
					$_POST['ajout_region'][]=$region;
					$detailsjeu->setAttr('id_region', $region->getAttr('id_region')); 
				}
			}
			if($_POST['nom_edition-'.$i]=='')
			{
				$detailsjeu->setAttr('id_edition', 0); 
			}
			else
			{
				$edition = Edition::findByName(strip_tags(str_replace("'","\'",$_POST['nom_edition-'.$i])));
				if(isset($edition[0])) 
				{
				$detailsjeu->setAttr('id_edition', $edition[0]->getAttr('id_edition')); 
				}
				else 
				{
					$edition = new Edition();
					$edition->setAttr('nom_edition',$_POST['nom_edition-'.$i]);
					$edition->save();
					$_POST['incomplet']=1;
					$_POST['ajout_edition'][]=$edition;
					$detailsjeu->setAttr('id_edition', $edition->getAttr('id_edition')); 
				}
			}
			if($_POST['nom_editeur-'.$i]=='')
			{
				$detailsjeu->setAttr('id_editeur', 0); 
			}
			else
			{
				$editeur = Editeur::findByName(strip_tags(str_replace("'","\'",$_POST['nom_editeur-'.$i])));
				if(isset($editeur[0])) 
				{ 
					$detailsjeu->setAttr('id_editeur', $editeur[0]->getAttr('id_editeur')); 
				}
				else
				{ 
					$editeur = new Editeur();
					$editeur->setAttr('nom_editeur',$_POST['nom_editeur-'.$i]);
					$editeur->save();
					$_POST['incomplet']=1;
					$_POST['ajout_editeur'][]=$editeur;
					$detailsjeu->setAttr('id_editeur', $editeur->getAttr('id_editeur')); 
				}
			}
			if($_POST['nom_support-'.$i]=='')
			{
				$detailsjeu->setAttr('id_support', 0); 
			}
			else
			{
				$support = Support::findByName(strip_tags(str_replace("'","\'",$_POST['nom_support-'.$i])));
				if(isset($support[0])) 
				{ 
					$detailsjeu->setAttr('id_support', $support[0]->getAttr('id_support')); 
				} 
				else 
				{ 
					$support = new Support();
					$support->setAttr('nom_support',$_POST['nom_support-'.$i]);
					$support->save();
					$_POST['incomplet']=1;
					$_POST['ajout_support'][]=$support;
					$detailsjeu->setAttr('id_support', $support->getAttr('id_support')); 
				}
			}
			if($_POST['nom_format-'.$i]=='')
			{
				$detailsjeu->setAttr('id_format', 0); 
			}
			else
			{
				$format = Format::findByName(strip_tags(str_replace("'","\'",$_POST['nom_format-'.$i])));
				if(isset($format[0])) 
				{ 
					$detailsjeu->setAttr('id_format', $format[0]->getAttr('id_format')); 
				} 
				else 
				{ 
					$format = new Format();
					$format->setAttr('nom_format',$_POST['nom_format-'.$i]);
					$format->save();
					$_POST['incomplet']=1;
					$_POST['ajout_format'][]=$format;
					$detailsjeu->setAttr('id_format', $format->getAttr('id_format')); 
				}
			}
			$detailsjeu->setAttr('reference_jeu', strip_tags(str_replace("'","\'",$_POST['reference_jeu-'.$i])));
			$detailsjeu->setAttr('code_barre_jeu', strip_tags(str_replace("'","\'",$_POST['code_barre_jeu-'.$i])));
			$detailsjeu->setAttr('version_jeu_valide', strip_tags(str_replace("'","\'",$_POST['version_jeu_valide-'.$i])));
			$detailsjeu->setAttr('date_sortie_jeu', strip_tags(str_replace("'","\'",$_POST['date_sortie_jeu-'.$i])));
			$detailsjeu->setAttr('remarque_version_jeu', strip_tags(str_replace("'","\'",$_POST['remarque_version_jeu-'.$i])));
			if (isset($_FILES['photo_boite-'.$i]) )
			{
				if($_FILES['photo_boite-'.$i]['name']!='')
				{
					if ($_FILES['photo_boite-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_boite-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_boite-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_boite-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.$j.'_boite.png';
						$resultat = move_uploaded_file($_FILES['photo_boite-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_boite', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_dos_boite-'.$i]) )
			{
				if($_FILES['photo_dos_boite-'.$i]['name']!='')
				{
					if ($_FILES['photo_dos_boite-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_dos_boite-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_dos_boite-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_dos_boite-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.$j.'_dos_boite.png';
						$resultat = move_uploaded_file($_FILES['photo_dos_boite-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_dos_boite', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_loose-'.$i]) )
			{
				if($_FILES['photo_loose-'.$i]['name']!='')
				{
					if ($_FILES['photo_loose-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_loose-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_loose-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_loose-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.$j.'_loose.png';
						$resultat = move_uploaded_file($_FILES['photo_loose-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_loose', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if (isset($_FILES['photo_notice-'.$i]) )
			{
				if($_FILES['photo_notice-'.$i]['name']!='')
				{
					if ($_FILES['photo_notice-'.$i]['error'] > 0)
					{
							switch($_FILES['photo_notice-'.$i]['error'])
							{
								case 1:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur')}); </script>";
									break;
								case 2:
									$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd pour le serveur (HTML)')}); </script>";
									break;
								case 3:
									$return= $return. "<script> $(function(){ alertify.error('Fichier partiellement téléchargé')}); </script>";
									break;
								case 4:
									$return= $return. "<script> $(function(){ alertify.error('Aucun fichier téléchargé')}); </script>";
									break;
								case 6:
									$return= $return. "<script> $(function(){ alertify.error('Dossier temporaire pour écriture non trouvé')}); </script>";
									break;
								case 7:
									$return= $return. "<script> $(function(){ alertify.error('Echec d'écriture sur le disque')}); </script>";
									break;
								case 8:
									$return= $return. "<script> $(function(){ alertify.error('Un script PHP à bloqué l'upload')}); </script>";
									break;
								default:
									$return= $return. "<script> $(function(){ alertify.error('Erreur lors du transfert : Raison inconnue')}); </script>";
									break;
							}
					}
					elseif ($_FILES['photo_notice-'.$i]['size'] > 1048576)
					{
						$return= $return. "<script> $(function(){ alertify.error('Fichier trop lourd (1Mo MAX)')}); </script>";
					}
					elseif (!in_array(strtolower(substr(strrchr($_FILES['photo_notice-'.$i]['name'],'.') ,1)), $formats))
					{
						$return= $return. "<script> $(function(){ alertify.error('Mauvais format (PNG, JPEG, BMP, GIF ou TIF uniquement)')}); </script>";
					}
					else
					{
						if (!is_dir('img/jeux/'.$jeu->getAttr('id_plateforme').'/')) 
						{
							mkdir('img/jeux/'.$jeu->getAttr('id_plateforme').'/');
						}
						$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
						$nom = 'img/jeux/'.$jeu->getAttr('id_plateforme').'/'.str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($_POST['nom_jeu'])))).'-'.$j.'_notice.png';
						$resultat = move_uploaded_file($_FILES['photo_notice-'.$i]['tmp_name'],$nom);
						$detailsjeu->setAttr('photo_notice', $nom);
						if(!$resultat)
						{
							$return= $return. "<script> $(function(){ alertify.error('Erreur dans la modification de la photo')}); </script>";
						}
					}
				}
			}
			if($detailsjeu->save()!=0)
			{
				$return= $return."<script> $(function(){ alertify.success('Version modifiée')}); </script>";
				if($user->data['user_id']!=1)
				{
					$db = Base::getConnection();
					$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',0,0,0,0,0,0,0,0,0,1,0,0) on duplicate key UPDATE modifs_versions_jeux = modifs_versions_jeux+1';
					$db->query($query);
				}
			}
				$j=1;
				$nb=0;
				
				Langue_jeu::deleteByVersion($detailsjeu->getAttr('id_version'));
				while(isset($_POST['langue-'.$i.'-'.$j]))
				{
					if($_POST['langue-'.$i.'-'.$j]!='')
					{
						$langue_jeu = new Langue_jeu();
						$langue = Langue::findByName(strip_tags(str_replace("'","\'",$_POST['langue-'.$i.'-'.$j])));
						if(isset($langue[0])) 
						{ 
							$langue_jeu->setAttr('id_langue', $langue[0]->getAttr('id_langue')); 
						} 
						else 
						{ 
							$langue = new Langue();
							$langue->setAttr('nom_langue',$_POST['langue-'.$i.'-'.$j]);
							$langue->save();
							$_POST['incomplet']=1;
							$_POST['ajout_langue'][]=$langue;
							$langue_jeu->setAttr('id_langue', $langue->getAttr('id_langue'));
						}
						$langue_jeu->setAttr("id_jeu",$jeu->getAttr('id_jeu'));
						$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
						$langue_jeu->save();
						if($langue_jeu->save()!=0)
						{
							$return= $return."<script> $(function(){ alertify.success('Langues modifiées')}); </script>";
						}
						$nb++;
					}
					$j++;
				}
				if($nb==0)
				{
						$langue_jeu = new Langue_jeu();
						$langue_jeu->setAttr("id_jeu",$jeu->getAttr('id_jeu'));
						$langue_jeu->setAttr("id_version",$detailsjeu->getAttr('id_version'));
						$langue_jeu->setAttr('id_langue', 0);
						$langue_jeu->save();
						if($langue_jeu->save()!=0)
						{
							$return= $return."<script> $(function(){ alertify.info('Aucune langue enregistrée')}); </script>";
						}
				}
				$j=1;
				Jeu_Inclus_Accessoire::deleteByVersion($detailsjeu->getAttr('id_version'));
				while(isset($_POST['accessoire-'.$i.'-'.$j]))
				{
					if($_POST['accessoire-'.$i.'-'.$j]!='')
					{
						$nom = strip_tags(str_replace("'","\'",$_POST['accessoire-'.$i.'-'.$j]));
						$plateforme = " (".$_POST['plateforme'].")";
						if(strpos($nom,$plateforme)!=null)
						{
							$nom = substr($nom,0,strpos($nom,$plateforme));
							$jeu_inclus_accessoire = new Jeu_Inclus_Accessoire();
							$accessoire = Accessoire::findByNameAndPlat($nom, $jeu->getAttr('id_plateforme'));
							if(isset($accessoire[0])) 
							{ 
								$jeu_inclus_accessoire->setAttr('id_accessoire', $accessoire[0]->getAttr('id_accessoire')); 
								$jeu_inclus_accessoire->setAttr("id_version",$detailsjeu->getAttr('id_version'));
								$jeu_inclus_accessoire->save();
							} 
							else
							{
								$return= $return."<script> $(function(){ alertify.error('Accessoire inexistant')}); </script>";
							}
						}
						else
						{
							$return= $return."<script> $(function(){ alertify.error('Les deux plateformes doivent être identiques (Jeu et Accessoire)')}); </script>";
						}

					}
					$j++;
				}
				if($_POST['nom_jeu-'.$i]!='')
				{
					$nom_jeu = nom_jeu::findByName(strip_tags(str_replace("'","\'",$_POST['nom_jeu-'.$i])));
					$autre_nom_jeu = new Autre_nom_jeu();
					if(isset($nom_jeu[0])) 
					{
						$autre_nom_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
						$autre_nom_jeu->setAttr('id_version', $detailsjeu->getAttr('id_version'));
						$autre_nom_jeu->setAttr('id_nom_jeu', $nom_jeu[0]->getAttr('id_nom_jeu')); 
						if($autre_nom_jeu->save()!=0)
						{
							$return= $return."<script> $(function(){ alertify.success('Nom de jeu modifié')}); </script>";
						}
					} 
					else 
					{
						$nom_jeu = new Nom_jeu();
						$nom_jeu->setAttr('nom_jeu', strip_tags(str_replace("'","\'",$_POST['nom_jeu-'.$i]))); 
						$autre_nom_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
						$autre_nom_jeu->setAttr('id_version', $detailsjeu->getAttr('id_version'));
						$autre_nom_jeu->setAttr('id_nom_jeu', $nom_jeu->save()); 
						if($autre_nom_jeu->save()!=0)
						{
							$return= $return."<script> $(function(){ alertify.success('Nom de jeu modifié')}); </script>";
						}
					}
				}
			$i++;
		}
		Commande_Jeu::deleteByIdJeu($jeu->getAttr('id_jeu'));
		$i=1;
		$nb=0;
		$_POST['ajout_commande']=array();
		while(isset($_POST['commande-'.$i]))
		{
			if($_POST['commande-'.$i]!='')
			{
				$commande = Commande::findByName(strip_tags(str_replace("'","\'",$_POST['commande-'.$i])));
				if(isset($commande[0])) 
				{
					$commande_jeu = new Commande_jeu();
					$commande_jeu->setAttr('id_commande', $commande[0]->getAttr('id_commande')); 
					$commande_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$commande_jeu->save();
					$nb++;
				} 
				else
				{
					$commande_jeu = new Commande_jeu();
					$commande = new Commande();
					$commande->setAttr('nom_commande',$_POST['commande-'.$i]);
					$commande->save();
					$_POST['incomplet']=1;
					$_POST['ajout_commande'][]=$commande;
					$commande_jeu->setAttr('id_commande', $commande->getAttr('id_commande')); 
					$commande_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$commande_jeu->save();
					$nb++;
				} 
			}
			$i++;
		}
		if($nb==0) 
		{
					$commande_jeu = new Commande_jeu();
					$commande_jeu->setAttr('id_commande', 0); 
					$commande_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$commande_jeu->save();
		} 
		
		autre_plateforme_jeu::deleteByIdJeu($jeu->getAttr('id_jeu'));
		$i=1;
		$nb=0;
		while(isset($_POST['autre_plateforme-'.$i]))
		{
			if($_POST['autre_plateforme-'.$i]!='')
			{
				$plateforme = Plateforme::findByName(strip_tags(str_replace("'","\'",$_POST['autre_plateforme-'.$i])));
				if(isset($plateforme[0])) 
				{
					$autre_plateforme_jeu = new Autre_plateforme_jeu();
					$autre_plateforme_jeu->setAttr('id_plateforme', $plateforme[0]->getAttr('id_plateforme')); 
					$autre_plateforme_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$autre_plateforme_jeu->save();
					$nb++;
				} 
				else
				{
					$autre_plateforme_jeu = new Autre_plateforme_jeu();
					$plateforme = new Plateforme();
					$plateforme->setAttr('nom_plateforme',$_POST['autre_plateforme-'.$i]);
					$plateforme->save();
					$_POST['incomplet']=1;
					$_POST['ajout_plateforme'][]=$plateforme;
					$autre_plateforme_jeu->setAttr('id_plateforme', $plateforme->getAttr('id_plateforme')); 
					$autre_plateforme_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$autre_plateforme_jeu->save();
					$nb++;
				}
			}
			$i++;
		}
		if($nb==0) 
		{
					$autre_plateforme_jeu = new Autre_plateforme_jeu();
					$autre_plateforme_jeu->setAttr('id_plateforme', 0); 
					$autre_plateforme_jeu->setAttr('id_jeu', $jeu->getAttr('id_jeu'));
					$autre_plateforme_jeu->save();
		} 
		if($jeu->save()!=0)
		{
			$return= $return."<script> $(function(){ alertify.success('Jeu modifié')}); </script>";
			if($user->data['user_id']!=1)
			{
				$db = Base::getConnection();
				$query = 'INSERT INTO user_stats VALUES('.$user->data['user_id'].',1,0,0,0,0,0,0,0,0,0,0,0) on duplicate key UPDATE modifs_jeux = modifs_jeux+1';
				$db->query($query);
			}
		}
	return $return;
}

function ajoutReportInformationErronee()
{
	$text = $text.$_POST['jeu'].'<br>';
	$text = $text.($_POST['check_nom_jeu']==1?'Nom: '.$_POST['nom_jeu'].'<br>':'');
	$text = $text.($_POST['check_plateforme']==1?'Plateforme: '.$_POST['plateforme'].'<br>':'');
	$text = $text.($_POST['check_type_jeu']==1?'Type: '.$_POST['type'].'<br>':'');
	$text = $text.($_POST['check_groupe']==1?'Groupe: '.$_POST['groupe'].'<br>':'');
	$text = $text.($_POST['check_developpeur']==1?'Developpeur: '.$_POST['developpeur'].'<br>':'');
	$text = $text.($_POST['check_nombre_joueurs']==1?'Nombre De Joueurs: '.$_POST['nombre_joueurs'].'<br>':'');
	foreach(Details_Jeu::findAllVersions($_POST['id_jeu']) as $version)
	{
		$i = $version['id_version'];
		$text = $text.'<br>'.$version['nom_region'].' Edition '.$version['nom_edition'].' :<br>';
		$text = $text.($_POST['nom_region-'.$i]==1?'Jeu inexistant dans la region<br>':'');
		$text = $text.($_POST['nom_edition-'.$i]==1?'Jeu inexistant dans cette edition<br>':'');
		$text = $text.($_POST['photo_loose-'.$i]==1?'Photo Loose Incorrecte<br>':'');
		$text = $text.($_POST['photo_notice-'.$i]==1?'Photo Notice Incorrecte<br>':'');
		$text = $text.($_POST['photo_boite-'.$i]==1?'Photo Boite Incorrecte<br>':'');
		$text = $text.($_POST['check_nom_editeur-'.$i]==1?'Editeur: '.$_POST['nom_editeur-'.$i].'<br>':'');
		$text = $text.($_POST['check_code_barre_jeu-'.$i]==1?'Code Barre: '.$_POST['code_barre_jeu-'.$i].'<br>':'');
		$text = $text.($_POST['check_reference_jeu-'.$i]==1?'Reference: '.$_POST['reference_jeu-'.$i].'<br>':'');
		$text = $text.($_POST['check_date_sortie_jeu-'.$i]==1?'Date de Sortie: '.$_POST['date_sortie_jeu-'.$i].'<br>':'');
		$text = $text.($_POST['check_nom_format-'.$i]==1?'Format: '.$_POST['nom_format-'.$i].'<br>':'');
		$text = $text.($_POST['check_nom_support-'.$i]==1?'Support: '.$_POST['nom_support-'.$i].'<br>':'');
		$text = $text.($_POST['check_autre_nom_jeu-'.$i]==1?'Nom Du Jeu: '.$_POST['autre_nom_jeu-'.$i].'<br>':'');
	}
	$rapport = new Rapport_Jeu();
	$rapport->setAttr('id_jeu',$_POST['jeu']);
	$rapport->setAttr('rapport_jeu', strip_tags(str_replace("'","\'",$text), "<a><br><img><div><span>"));
	if($rapport->save()==0)
	{
		return "<script> $(function(){ alertify.error('Sauvegarde impossible')}); </script>";
	}
	else
	{
		return "<script> $(function(){ alertify.success('Rapport sauvegardé')}); </script>";
	}
}
?>