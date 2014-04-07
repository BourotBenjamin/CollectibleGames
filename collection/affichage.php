<?php

function affiche_membres()
{
	foreach(getListeMembres() as $row)
	{
		echo"<a href='collection.php?viewCollection=".$row['user_id']."'><img height=90 width=90 ".('./forum/download/file.php?avatar='!=$row['user_avatar']?"src='".$row['user_avatar']."'":"")." title='avatar'> ".$row['username']." ".$row['nbJ']." jeux, ".$row['nbC']." consoles, ".$row['nbA']." accessoires. ".$row['points']." contributions </a><br>";
	}
}

function affiche_ajout_possession_jeu($jeu, $versions)
{
	echo"<div class='Titre'>Informations concernant votre jeu : ".$jeu['nom_jeu']." sur ".$jeu['nom_plateforme']."</div>
	<form action='' method=POST>
	<input type=hidden name='id_jeu' value='".$jeu['id_jeu']."'>
	Etat : <SELECT name='etat'>
	<OPTION>Neuf
	<OPTION>Très Bon
	<OPTION>Bon
	<OPTION>Moyen
	<OPTION>Mauvais
	</SELECT><br>
	Version : <SELECT name='version'>";
	$temp=array();
	foreach($versions as $v)
	{
			echo"<OPTION> Region : ".$v['nom_region']." ; Version : ".$v['nom_edition'];
	}
	echo"</SELECT><br>
	<input type=checkbox name='blister_rigide' value=1> Blister Rigide
	<input type=checkbox name='blister_souple' value=1> Blister Souple
	<input type=checkbox name='boite' value=1> Boite
	<input type=checkbox name='notice' value=1> Notice
	<input type=checkbox name='cartouche' value=1> Jeu
	<input type=checkbox name='cale' value=1> Cale<br>
	Commentaire : <TEXTAREA name='commentaire'></TEXTAREA><br>
	<input type=submit name='validerInformationsPossessionJeu' value='Valider pour ce jeu'>
	<input type=submit name='validerInformationsPossessionsJeuxSuivants' value='Valider ces informations pour tous les jeux suivants'>";
	$i=0;
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			$i++;
			echo"<input type=hidden name='".intval($key)."' value='1'>";
		}
	}
	if($i>0)
	{
		echo"<input type=hidden name='validerAjoutPossessionJeu' value='1'>";
	}
	echo"</form>";
}

function affiche_modifier_possession_jeu($jeu, $versions, $possession, $uid)
{
	if($possession['user_id']==$uid)
	{
		echo"<div class='Titre'>Informations concernant votre jeu : ".$jeu['nom_jeu']." sur ".$jeu['nom_plateforme']."</div>
		<form action='collection.php' method=POST>
		<input type=hidden name='id_jeu' value='".$jeu['id_jeu']."'>
		<input type=hidden name='id_possede_jeu' value='".$possession['id_possede_jeu']."'>
		Etat : <SELECT name='etat'>
		<OPTION ".($possession['etat_jeu']==4?'SELECTED':'').">Neuf
		<OPTION ".($possession['etat_jeu']==3?'SELECTED':'').">Très Bon
		<OPTION ".($possession['etat_jeu']==2?'SELECTED':'').">Bon
		<OPTION ".($possession['etat_jeu']==1?'SELECTED':'').">Moyen
		<OPTION ".($possession['etat_jeu']==0?'SELECTED':'').">Mauvais
		</SELECT><br>
		Version : <SELECT name='version'>";
		$temp=array();
		foreach($versions as $v)
		{
				echo"<OPTION>Region : ".$v['nom_region']." ; Version : ".$v['nom_edition'];
		}
		echo"</SELECT><br>
		<input type=checkbox name='blister_rigide' value=1 ".($possession['blister_rigide_jeu']==1?'checked':'')."> Blister Rigide
		<input type=checkbox name='blister_souple' value=1 ".($possession['blister_souple_jeu']==1?'checked':'')."> Blister Souple
		<input type=checkbox name='boite' value=1 ".($possession['boite_jeu']==1?'checked':'')."> Boite
		<input type=checkbox name='notice' value=1 ".($possession['notice_jeu']==1?'checked':'')."> Notice
		<input type=checkbox name='cartouche' value=1 ".($possession['cartouche_jeu']==1?'checked':'')."> Jeu
		<input type=checkbox name='cale' value=1 ".($possession['cale_jeu']==1?'checked':'')."> Cale<br>
		Commentaire : <TEXTAREA name='commentaire'>".$possession['commentaire_jeu']."</TEXTAREA><br>
		<input type=submit name='validerInformationsPossessionJeu' value='Valider les modifications'>
		</form>";
	}
	else
	{
		echo "Vous n'avez pas le droit de modifier ces informations";
	}
	
}

function affiche_ajout_possession_accessoire($accessoire, $versions)
{
	echo"<div class='Titre'>Informations concernant votre accessoire : ".$accessoire['nom_accessoire']." sur ".$accessoire['nom_plateforme']."</div>
	<form action='' method=POST>
	<input type=hidden name='id_accessoire' value='".$accessoire['id_accessoire']."'>
	Etat : <SELECT name='etat'>
	<OPTION>Neuf
	<OPTION>Très Bon
	<OPTION>Bon
	<OPTION>Moyen
	<OPTION>Mauvais
	</SELECT><br>
	Region : <SELECT name='region'>";
	$temp=array();
	foreach($versions as $v)
	{
		if(!isset($temp[$v['nom_region']]))
		{
			$temp[$v['nom_region']]=1;
			echo"<OPTION>".$v['nom_region'];
		}
	}
	echo"</SELECT><br>
	<input type=checkbox name='blister_rigide' value=1> Blister Rigide
	<input type=checkbox name='blister_souple' value=1> Blister Souple
	<input type=checkbox name='boite' value=1> Boite
	<input type=checkbox name='notice' value=1> Notice
	<input type=checkbox name='materiel' value=1> Accessoire<br>
	Commentaire : <TEXTAREA name='commentaire'></TEXTAREA><br>
	<input type=submit name='validerInformationsPossessionAccessoire' value='Valider pour cet accessoire'>
	<input type=submit name='validerInformationsPossessionsAccessoiresSuivants' value='Valider ces informations pour tous les accessoires suivants'>";
	$i=0;
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			$i++;
			echo"<input type=hidden name='".intval($key)."' value='1'>";
		}
	}
	if($i>0)
	{
		echo"<input type=hidden name='validerAjoutPossessionAccessoire' value='1'>";
	}
	echo"</form>";
	
}

function affiche_modifier_possession_accessoire($accessoire, $versions, $possession, $uid)
{
	if($possession['user_id']==$uid)
	{
		echo"<div class='Titre'>Informations concernant votre accessoire : ".$accessoire['nom_accessoire']." sur ".$accessoire['nom_plateforme']."</div>
		<form action='collection.php' method=POST>
		<input type=hidden name='id_accessoire' value='".$accessoire['id_accessoire']."'>
		<input type=hidden name='id_possede_accessoire' value='".$possession['id_possede_accessoire']."'>
		Etat : <SELECT name='etat'>
		<OPTION ".($possession['etat_accessoire']==4?'SELECTED':'').">Neuf
		<OPTION ".($possession['etat_accessoire']==3?'SELECTED':'').">Très Bon
		<OPTION ".($possession['etat_accessoire']==2?'SELECTED':'').">Bon
		<OPTION ".($possession['etat_accessoire']==1?'SELECTED':'').">Moyen
		<OPTION ".($possession['etat_accessoire']==0?'SELECTED':'').">Mauvais
		</SELECT><br>
		Region : <SELECT name='region'>";
		$temp=array();
		foreach($versions as $v)
		{
			if(!isset($temp[$v['nom_region']]))
			{
				$temp[$v['nom_region']]=1;
				echo"<OPTION ".($v['nom_region']==$possession['nom_region']?'SELECTED':'').">".$v['nom_region'];
			}
		}
		echo"</SELECT><br>
		<input type=checkbox name='blister_rigide' value=1 ".($possession['blister_rigide_accessoire']==1?'checked':'')."> Blister Rigide
		<input type=checkbox name='blister_souple' value=1 ".($possession['blister_souple_accessoire']==1?'checked':'')."> Blister Souple
		<input type=checkbox name='boite' value=1 ".($possession['boite_accessoire']==1?'checked':'')."> Boite
		<input type=checkbox name='notice' value=1 ".($possession['notice_accessoire']==1?'checked':'')."> Notice
		<input type=checkbox name='materiel' value=1 ".($possession['materiel_accessoire']==1?'checked':'')."> Accessoire<br>
		Commentaire : <TEXTAREA name='commentaire'>".$possession['commentaire_accessoire']."</TEXTAREA><br>
		<input type=submit name='validerInformationsPossessionAccessoire' value='Valider les modifications'>
		</form>";
	}
	else
	{
		echo "Vous n'avez pas le droit de modifier ces informations";
	}
	
}

function affiche_ajout_possession_console($console, $versions)
{
	echo"<div class='Titre'>Informations concernant votre pack : ".$console['nom_console']." ( Plateforme : ".$console['nom_plateforme']." )</div>
	<form action='' method=POST>
	<input type=hidden name='id_console' value='".$console['id_console']."'>
	Etat : <SELECT name='etat'>
	<OPTION>Neuf
	<OPTION>Très Bon
	<OPTION>Bon
	<OPTION>Moyen
	<OPTION>Mauvais
	</SELECT><br>
	Region : <SELECT name='region'>";
	$temp=array();
	foreach($versions as $v)
	{
		if(!isset($temp[$v['nom_region']]))
		{
			$temp[$v['nom_region']]=1;
			echo"<OPTION>".$v['nom_region'];
		}
	}
	echo"</SELECT><br>
	<input type=checkbox name='scelle' value=1> Boite Scellée
	<input type=checkbox name='cale' value=1> Cale
	<input type=checkbox name='boite' value=1> Boite
	<input type=checkbox name='notice' value=1> Notice
	<input type=checkbox name='machine' value=1> Console<br>
	Commentaire : <TEXTAREA name='commentaire'></TEXTAREA><br>
	<input type=submit name='validerInformationsPossessionConsole' value='Valider pour cette console'>
	<input type=submit name='validerInformationsPossessionsConsolesSuivantes' value='Valider ces informations pour toutes les consoles suivantes'>";
	$i=0;
	foreach($_POST as $key => $value)
	{
		if(intval($key)!=0)
		{
			$i++;
			echo"<input type=hidden name='".intval($key)."' value='1'>";
		}
	}
	if($i>0)
	{
		echo"<input type=hidden name='validerAjoutPossessionConsole' value='1'>";
	}
	echo"</form>";
	
}

function affiche_modifier_possession_console($console, $versions, $possession, $uid)
{
	if($possession['user_id']==$uid)
	{
		echo"<div class='Titre'>Informations concernant votre console : ".$console['nom_console']." ( Plateforme : ".$console['nom_plateforme']." )</div>
		<form action='collection.php' method=POST>
		<input type=hidden name='id_console' value='".$console['id_console']."'>
		<input type=hidden name='id_possede_console' value='".$possession['id_possede_console']."'>
		Etat : <SELECT name='etat'>
		<OPTION ".($possession['etat_console']==4?'SELECTED':'').">Neuf
		<OPTION ".($possession['etat_console']==3?'SELECTED':'').">Très Bon
		<OPTION ".($possession['etat_console']==2?'SELECTED':'').">Bon
		<OPTION ".($possession['etat_console']==1?'SELECTED':'').">Moyen
		<OPTION ".($possession['etat_console']==0?'SELECTED':'').">Mauvais
		</SELECT><br>
		Region : <SELECT name='region'>";
		$temp=array();
		foreach($versions as $v)
		{
			if(!isset($temp[$v['nom_region']]))
			{
				$temp[$v['nom_region']]=1;
				echo"<OPTION ".($v['nom_region']==$possession['nom_region']?'SELECTED':'').">".$v['nom_region'];
			}
		}
		echo"</SELECT><br>
		<input type=checkbox name='scellee' value=1 ".($possession['console_scelle']==1?'checked':'')."> Boite Scellée
		<input type=checkbox name='boite' value=1 ".($possession['boite_console']==1?'checked':'')."> Boite
		<input type=checkbox name='notice' value=1 ".($possession['notice_console']==1?'checked':'')."> Notice
		<input type=checkbox name='machine' value=1 ".($possession['machine_console']==1?'checked':'')."> Console
		<input type=checkbox name='cale' value=1 ".($possession['cale_console']==1?'checked':'')."> Cale<br>
		Commentaire : <TEXTAREA name='commentaire'>".$possession['commentaire_console']."</TEXTAREA><br>
		<input type=submit name='validerInformationsPossessionConsole' value='Valider les modifications'>
		</form>";
	}
	else
	{
		echo "Vous n'avez pas le droit de modifier ces informations";
	}
	
}

function affiche_collection($jeux, $consoles, $accessoires, $albums, $modifAutorisee, $name, $id)
{
	echo'<div class="Titre">Collection de '.$name.'</div><br>
	<div class="Titre">Albums Photos ';
	if($modifAutorisee)
	{
			echo '<a href="collection.php?action=createAlbum">( Créer un nouvel album photo )</a>';
	}
	echo'</div><br>';
	$width = 0;
	$x=0;
	foreach($albums as $row)
	{
		$src="";
		if($row['couverture_album'])
		{
			$cover = Photo::findById($row['couverture_album']);
			if($cover)
			{
				$src=$cover->getAttr('url_photo');
			}
		}
		if($src=="" && $row['photos'][0])
		{
			$src=$row['photos'][0]['url_photo'];
		}
		echo ' <a style=" display: inline-block; padding-right:10px;" href="collection.php?viewAlbum='.$row['id_album'].'"> 
			<img height=100 src="'.$src.'" alt="'.$row['titre_album'].'" title="'.$row['titre_album'].'" /> 
			<div class="titleAlbum">'.$row['titre_album'].'</div>
		</a> ';
	}
	echo'
	<div class="Titre">Jeux</div><br>';
	$width = 0;
	$x=0;
	foreach($jeux as $row)
	{
		if($modifAutorisee)
		{
			echo'<span class="infosPossessionUser" id="Jeu'.$row['id_possede_jeu'].'">';
		}
		else
		{
			echo'<span class="infosPossession" id="Jeu'.$row['id_possede_jeu'].'">';
		}
		$width+=$x;
		if($row['boite_jeu'])
		{
			$x=0;
			if(is_file($row['photo_boite']))
			{
				$img = getimagesize($row['photo_boite']);
				$x=$img[0]*(100/$img[1]);
			}
			echo"<img width=".$x." height=100 src='".$row['photo_boite']."'> ";
		}
		else if($row['cartouche_jeu'])
		{
			$x=0;
			if(is_file($row['photo_loose']))
			{
				$img = getimagesize($row['photo_loose']);
				$x=$img[0]*(100/$img[1]);
			}
			echo"<img width=".$x." height=100 src='".$row['photo_loose']."'> ";
		}
		else if($row['notice_jeu'])
		{
			$x=0;
			if(is_file($row['photo_notice']))
			{
				$img = getimagesize($row['photo_notice']);
				$x=$img[0]*(100/$img[1]);
			}
			echo"<img width=".$x." height=100 src='".$row['photo_notice']."'> ";
		}
		echo '<span>';
		if($modifAutorisee)
		{
			echo'<br><div class="edit"><a href="collection.php?action=editJeu&id='.$row['id_possede_jeu'].'"><img src="./img/collection_edit.png" title="Modifier la possession"/></a></div>';
			echo'<br><div class="suppr"><a href="collection.php?action=supprJeu&id='.$row['id_possede_jeu'].'"><img src="./img/collection_suppr.png" title="Supprimer la possession"/></a></div>';
		}
		echo'<table><tr><td><a href="bddjv.php?action=view&id='.$row['id_jeu'].'">'.$row['nom_jeu'].'</a><br>';
		echo($row['blister_rigide_jeu']?'<img width=25 height=25 src="img/blister_rigide_present.png" title="Blister rigide présent">':'<img width=25 height=25 src="img/blister_rigide_absent.png" title="Blister rigide absent">');
		echo($row['blister_souple_jeu']?'<img width=25 height=25 src="img/blister_souple_present.png" title="Blister souple présent">':'<img width=25 height=25 src="img/blister_souple_absent.png" title="Blister souple absent">');
		echo($row['boite_jeu']?'<img width=25 height=25 src="img/boite_presente.png" title="Boite présente">':'<img width=25 height=25 src="img/boite_absente.png" title="Boite absente">');
		echo($row['notice_jeu']?'<img width=25 height=25 src="img/notice_presente.png" title="Notice présente">':'<img width=25 height=25 src="img/notice_absente.png" title="Notice absente">');
		echo($row['cale_jeu']?'<img width=25 height=25 src="img/cale_presente.png" title="Cale présente">':'<img width=25 height=25 src="img/cale_absente.png" title="Cale absente">');
		echo($row['cartouche_jeu']?'<img width=25 height=25 src="img/cartouche_presente.png" title="Cartouche présente">':'<img width=25 height=25 src="img/cartouche_absente.png" title="Cartouche absente">');
		switch($row['etat_jeu'])
		{
			case 0:
				echo'<br>Etat : Mauvais<br>';
				break;
			case 1:
				echo'<br>Etat : Moyen<br>';
				break;
			case 2:
				echo'<br>Etat : Bon<br>';
				break;
			case 3:
				echo'<br>Etat : Très Bon<br>';
				break;
			case 4:
				echo'<br>Etat : Neuf<br>';
				break;
		}
		echo$row['commentaire_jeu'];
		echo'</td></tr></table></span></span>';
	}
	echo'<div class="Titre">Consoles</div><br>';
	$width = 0;
	$x=0;
	foreach($consoles as $row)
	{
		if($modifAutorisee)
		{
			echo'<span class="infosPossessionUser" id="Console'.$row['id_possede_console'].'">';
		}
		else
		{
			echo'<span class="infosPossession" id="Console'.$row['id_possede_console'].'">';
		}
		$width+=$x;
		if($width>1200)
		{
			echo'<br>';
		}
		$x=0;
		if(is_file($row['photo_console']))
		{
			$img = getimagesize($row['photo_console']);
			$x=$img[0]*(100/$img[1]);
		}
		echo"<img width=".$x." height=100 src='".$row['photo_console']."'> ";
		echo'<span>';
		if($modifAutorisee)
		{
			echo'<br><div class="edit"><a href="collection.php?action=editConsole&id='.$row['id_possede_console'].'"><img src="./img/collection_edit.png" title="Modifier la possession"/></a></div>';
			echo'<br><div class="suppr"><a href="collection.php?action=supprConsole&id='.$row['id_possede_console'].'"><img src="./img/collection_suppr.png" title="Supprimer la possession"/></a></div>';
		}
		echo'<table><tr><td><a href="bddjv.php?action=viewConsole&id='.$row['id_console'].'">'.$row['nom_console'].'</a><br>';
		echo($row['console_scelle']?'<img width=25 height=25 src="img/console_scellee.png" title="Console scellée">':'<img width=25 height=25 src="img/console_non_scellee.png" title="Console non scellée">');
		echo($row['boite_console']?'<img width=25 height=25 src="img/boite_presente.png" title="Boite présente">':'<img width=25 height=25 src="img/boite_absente.png" title="Boite absente">');
		echo($row['notice_console']?'<img width=25 height=25 src="img/notice_presente.png" title="Notice présente">':'<img width=25 height=25 src="img/notice_absente.png" title="Notice absente">');
		echo($row['cale_console']?'<img width=25 height=25 src="img/cale_presente.png" title="Cale présente">':'<img width=25 height=25 src="img/cale_absente.png" title="Cale absente">');
		echo($row['machine_console']?'<img width=25 height=25 src="img/machine_presente.png" title="Machine présente">':'<img width=25 height=25 src="img/machine_absente.png" title="Machine absente">');
		switch($row['etat_console'])
		{
			case 0:
				echo'<br>Etat : Mauvais<br>';
				break;
			case 1:
				echo'<br>Etat : Moyen<br>';
				break;
			case 2:
				echo'<br>Etat : Bon<br>';
				break;
			case 3:
				echo'<br>Etat : Très Bon<br>';
				break;
			case 4:
				echo'<br>Etat : Neuf<br>';
				break;
		}
		echo$row['commentaire_console'];
		echo'</td></tr></table></span></span>';
	}
	echo'<div class="Titre">Accessoire</div><br>';
	$width = 0;
	$x=0;
	foreach($accessoires as $row)
	{
		if($modifAutorisee)
		{
			echo'<span class="infosPossessionUser" id="Accessoire'.$row['id_possede_accessoire'].'">';
		}
		else
		{
			echo'<span class="infosPossession" id="Accessoire'.$row['id_possede_accessoire'].'">';
		}
		$width+=$x;
		if($width>1200)
		{
			echo'<br>';
		}
		$x=0;
		if(is_file($row['photo_accessoire']))
		{
			$img = getimagesize($row['photo_accessoire']);
			$x=$img[0]*(100/$img[1]);
		}
		echo"<img width=".$x." height=100 src='".$row['photo_accessoire']."'> ";
		echo'<span>';
		if($modifAutorisee)
		{
			echo'<br><div class="edit"><a href="collection.php?action=editAccessoire&id='.$row['id_possede_accessoire'].'"><img src="./img/collection_edit.png" title="Modifier la possession"/></a></div>';
			echo'<br><div class="suppr"><a href="collection.php?action=supprAccessoire&id='.$row['id_possede_accessoire'].'"><img src="./img/collection_suppr.png" title="Supprimer la possession"/></a></div>';
		}
		echo'<table><tr><td><a href="bddjv.php?action=viewAccessoire&id='.$row['id_accessoire'].'">'.$row['nom_accessoire'].'</a><br>';
		echo($row['blister_rigide_accessoire']?'<img width=25 height=25 src="img/blister_rigide_present.png" title="Blister rigide présent">':'<img width=25 height=25 src="img/blister_rigide_absent.png" title="Blister rigide absent">');
		echo($row['blister_souple_accessoire']?'<img width=25 height=25 src="img/blister_souple_present.png" title="Blister souple présent">':'<img width=25 height=25 src="img/blister_souple_absent.png" title="Blister souple absent">');
		echo($row['boite_accessoire']?'<img width=25 height=25 src="img/boite_presente.png" title="Boite présente">':'<img width=25 height=25 src="img/boite_absente.png" title="Boite absente">');
		echo($row['notice_accessoire']?'<img width=25 height=25 src="img/notice_presente.png" title="Notice présente">':'<img width=25 height=25 src="img/notice_absente.png" title="Notice absente">');
		echo($row['materiel_accessoire']?'<img width=25 height=25 src="img/materiel_present.png" title="Matériel présent">':'<img width=25 height=25 src="img/materiel_absent.png" title="Matériel absent">');
		switch($row['etat_accessoire'])
		{
			case 0:
				echo'<br>Etat : Mauvais<br>';
				break;
			case 1:
				echo'<br>Etat : Moyen<br>';
				break;
			case 2:
				echo'<br>Etat : Bon<br>';
				break;
			case 3:
				echo'<br>Etat : Très Bon<br>';
				break;
			case 4:
				echo'<br>Etat : Neuf<br>';
				break;
		}
		echo$row['commentaire_accessoire'];
		echo'</td></tr></table></span></span>';
	}
	echo'<br><br><a href="collection.php?exportCollection='.$id.'"> Export de la collection de '.$name.' </a>';
	
}

function export_collection($jeux, $consoles, $accessoires, $nom)
{
	header('Content-type: text/html', true);
	header('Content-Disposition: attachment; filename="'.$nom.'.txt"',true);
	echo "Collection de ".$nom."\r\nJeux\r\n\r\n";
	$width = 0;
	$x=0;
	foreach($jeux as $row)
	{
		echo$row['nom_jeu'].' ; ';
		echo($row['blister_rigide_jeu']?'Blister rigide ; ':'');
		echo($row['blister_souple_jeu']?'Blister souple ; ':'');
		echo($row['boite_jeu']?'Boite ; ':'');
		echo($row['notice_jeu']?'Notice ; ':'');
		echo($row['cale_jeu']?'Cale ; ':'');
		echo($row['cartouche_jeu']?'Jeu ; ':'');
		switch($row['etat_jeu'])
		{
			case 0:
				echo'Etat : Mauvais';
				break;
			case 1:
				echo'Etat : Moyen';
				break;
			case 2:
				echo'Etat : Bon';
				break;
			case 3:
				echo'Etat : Très Bon';
				break;
			case 4:
				echo'Etat : Neuf';
				break;
		}
		echo' ; '.$row['commentaire_jeu']."\r\n";
	}
	echo"\r\nConsoles\r\n\r\n";
	$width = 0;
	$x=0;
	foreach($consoles as $row)
	{
		echo$row['nom_console'].' ; ';
		echo($row['console_scelle']?'Console scellée ; ':'');
		echo($row['boite_console']?'Boite ; ':'');
		echo($row['notice_console']?'Notice ; ':'');
		echo($row['cale_console']?'Cale ; ':'');
		echo($row['machine_console']?'Console ; ':'');
		switch($row['etat_console'])
		{
			case 0:
				echo'Etat : Mauvais';
				break;
			case 1:
				echo'Etat : Moyen';
				break;
			case 2:
				echo'Etat : Bon';
				break;
			case 3:
				echo'Etat : Très Bon';
				break;
			case 4:
				echo'Etat : Neuf';
				break;
		}
		echo' ; '.$row['commentaire_console']."\r\n";
	}
	echo"\r\nAccessoire\r\n\r\n";
	$width = 0;
	$x=0;
	foreach($accessoires as $row)
	{
		echo$row['nom_accessoire'].' ; ';
		echo($row['blister_rigide_accessoire']?'Blister rigide ; ':'');
		echo($row['blister_souple_accessoire']?'Blister souple ; ':'');
		echo($row['boite_accessoire']?'Boite ; ':'');
		echo($row['notice_accessoire']?'Notice ; ':'');
		echo($row['materiel_accessoire']?'Accessoire ; ':'');
		switch($row['etat_accessoire'])
		{
			case 0:
				echo'Etat : Mauvais';
				break;
			case 1:
				echo'Etat : Moyen';
				break;
			case 2:
				echo'Etat : Bon';
				break;
			case 3:
				echo'Etat : Très Bon';
				break;
			case 4:
				echo'Etat : Neuf';
				break;
		}
		echo' ; '.$row['commentaire_accessoire']."\r\n";
	}
}

function export_collection_csv($jeux, $consoles, $accessoires, $nom)
{
	header('Content-type: text/html', true);
	header('Content-Disposition: attachment; filename="'.$nom.'.csv"',true);
	echo "Collection de ".$nom."\r\n\r\n";
	echo "Jeu;Blister Rigide;Blister Souple;Boite;Notice;Cale;Jeu;Etat;Commentaire;\r\n\r\n";
	foreach($jeux as $row)
	{
		echo $row['nom_jeu'].';';
		echo($row['blister_rigide_jeu']?'Oui;':'Non;');
		echo($row['blister_souple_jeu']?'Oui;':'Non;');
		echo($row['boite_jeu']?'Oui;':'Non;');
		echo($row['notice_jeu']?'Oui;':'Non;');
		echo($row['cale_jeu']?'Oui;':'Non;');
		echo($row['cartouche_jeu']?'Oui;':'Non;');
		switch($row['etat_jeu'])
		{
			case 0:
				echo'Mauvais';
				break;
			case 1:
				echo'Moyen';
				break;
			case 2:
				echo'Bon';
				break;
			case 3:
				echo'Très Bon';
				break;
			case 4:
				echo'Neuf';
				break;
		}
		echo';'.$row['commentaire_jeu']."\r\n";
	}
	echo "\r\n\r\n";
	echo "Console;Scellée;Boite;Notice;Cale;Console;Etat;Commentaire\r\n\r\n";
	foreach($consoles as $row)
	{
		echo $row['nom_console'].';';
		echo($row['console_scelle']?'Oui;':'Non;');
		echo($row['boite_console']?'Oui;':'Non;');
		echo($row['notice_console']?'Oui;':'Non;');
		echo($row['cale_console']?'Oui;':'Non;');
		echo($row['machine_console']?'Oui;':'Non;');
		switch($row['etat_console'])
		{
			case 0:
				echo'Mauvais';
				break;
			case 1:
				echo'Moyen';
				break;
			case 2:
				echo'Bon';
				break;
			case 3:
				echo'Très Bon';
				break;
			case 4:
				echo'Neuf';
				break;
		}
		echo ';'.$row['commentaire_console']."\r\n";
	}
	echo "\r\n\r\n";
	echo "Accessoire;Blister Rigide;Blister Souple;Boite;Notice;Cale;Console;Etat;Commentaire\r\n\r\n";
	foreach($accessoires as $row)
	{
		echo $row['nom_accessoire'].';';
		echo($row['blister_rigide_accessoire']?'Oui;':'Non;');
		echo($row['blister_souple_accessoire']?'Oui;':'Non;');
		echo($row['boite_accessoire']?'Oui;':'Non;');
		echo($row['notice_accessoire']?'Oui;':'Non;');
		echo($row['materiel_accessoire']?'Oui;':'Non;');
		switch($row['etat_accessoire'])
		{
			case 0:
				echo'Mauvais';
				break;
			case 1:
				echo'Moyen';
				break;
			case 2:
				echo'Bon';
				break;
			case 3:
				echo'Très Bon';
				break;
			case 4:
				echo'Neuf';
				break;
		}
		echo ';'.$row['commentaire_accessoire']."\r\n";
	}
}

function affiche_ajout_album_photo($uid)
{
	if($uid>1)
	{
		echo"<div class='Titre'>Créer un album photo : </div>
		<form action='collection.php' method=POST enctype='multipart/form-data'>
		<input type=hidden name='user_id' value='".$uid."'>
		Nom :<br> <input type=text name='titre_album'><br>
		Description :<br> <TEXTAREA name='description_album'></TEXTAREA><br>
		<input type=submit name='validerAjoutAlbumPhoto' value=\"Créer l'album\">
		</form>";
	}
	else
	{
		echo "Vous devez vous connecter pour créer un album.";
	}
}

function affiche_modifier_album_photo($album, $uid)
{
	if($album['user_id']==$uid)
	{
		echo"<div class='Titre'>Modifier un album photo : </div>
		<form action='collection.php' method=POST enctype='multipart/form-data'>
		<input type=hidden name='user_id' value='".$uid."'>
		<input type=hidden name='id_album' value='".$album['id_album']."'>
		Nom :<br> <input type=text name='titre_album' value='".$album['titre_album']."'><br>
		Description :<br> <TEXTAREA name='description_album'>".$album['description_album']."</TEXTAREA><br>
		<input type=submit name='validerAjoutAlbumPhoto' value='Valider les modifications'>
		</form>";
	}
	else
	{
		echo "Vous n'avez pas le droit de modifier cet album";
	}
}

function affiche_album_photo($album, $uid)
{
	echo '<h1>Album '.$album['titre_album'].' de '.$album['username'].'<br></h1>'.$album['description_album'].'<br><br>';
	foreach( $album['photos'] as $photo)
	{
		if($album['user_id']==$uid)
		{
			echo '<span class="photoAlbumUser">';
			echo '<span class="editPhoto"><a href="collection.php?action=editPhoto&id='.$photo['id_photo'].'" ><img src="img/edit.png" /></a></span>';
			echo '<a title="'.$photo['nom_photo'].'" description="'.$photo['description_photo'].'"   href="'.$photo['url_photo'].'" class="zoombox zgallery1"><img title="'.$photo['nom_photo'].'" height=100 src="'.$photo['url_photo'].'" /></a>';
			echo '<span class="supprPhoto"><a href="collection.php?action=supprPhoto&id='.$photo['id_photo'].'" ><img src="img/close.png" /></a></span>';
		}
		else
		{
			echo '<span class="photoAlbum">';
			echo '<a title="'.$photo['nom_photo'].'" description="'.$photo['description_photo'].'"   href="'.$photo['url_photo'].'" class="zoombox zgallery1"><img title="'.$photo['nom_photo'].'" height=100 src="'.$photo['url_photo'].'" /></a>';
		}
		echo '</span>';
	}
	echo '<br><br>Cliquez sur les images pour les agrandir
	<script type="text/javascript">
        jQuery(function($){
            $("a.zoombox").zoombox();
        });
    </script>';
	if($album['user_id']==$uid)
	{
		echo '<br><br><h2>Ajouter des images à l\'album:</h2>
		<br><form action="collection/upload_images.php" class="dropzone">
		<input type=hidden name="user_id" value="'.$uid.'">
		<input type=hidden name="id_album" value="'.$album['id_album'].'">
		</form><br>
		<a href="collection.php?editAlbum='.$album['id_album'].'">Modifier les informations de l\'album</a>';
	}
}

function affiche_modifier_photo($photo, $canModify)
{
	if($canModify)
	{
		echo"<div class='Titre'>Modifier la photo suivante: </div><br>
		<img src='".$photo->getAttr('url_photo')."' height=100 /><br><br>
		<form action='collection.php?viewAlbum=".$photo->getAttr('id_album')."' method=POST enctype='multipart/form-data'>
		<input type=hidden name='id_photo' value='".$photo->getAttr('id_photo')."'>
		<input type=hidden name='id_album' value='".$photo->getAttr('id_album')."'>
		Nom :<br> <input type=text name='nom_photo' value='".$photo->getAttr('nom_photo')."'><br>
		Description :<br> <TEXTAREA name='description_photo'>".$photo->getAttr('description_photo')."</TEXTAREA><br>
		<input type='checkbox' name='albumCover' value='1'> Faire de cette photo la couverture de l'album<br>
		<input type=submit name='validerModifierPhoto' value='Valider les modifications'>
		</form>";
	}
	else
	{
		echo "Vous n'avez pas le droit de modifier cet album";
	}
}

?>