<?php

class Jeu {


  private $id_jeu ; 
  private $id_nom_jeu;
  private $id_plateforme;
  private $id_type_jeu;
  private $id_groupe;
  private $id_developpeur;
  private $nombre_joueurs;
  private $jeu_valide;
  private $remarque_jeu;

	public function __construct() {}

	public function __toString() {
        return "[". __CLASS__ . "] id_jeu : ". $this->id_jeu . "
				   id_nom_jeu  ". $this->id_nom_jeu  ."
				   id_plateforme ". $this->id_plateforme."
				   id_type_jeu  ". $this->id_type_jeu ."
				   id_groupe ". $this->id_groupe  ." 
				    id_developpeur ". $this->id_developpeur ."
				   nombre_joueurs ". $this->nombre_joueurs ."
				   jeu_valide ". $this->jeu_valide ."
				   remarque_jeu ". $this->remarque_jeu;
  }

	public function getAttr($attr_name) {
    if (property_exists( __CLASS__, $attr_name)) { 
      return $this->$attr_name;
    } 
    $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
    throw new Exception($emess, 45);
  }
   
	public function setAttr($attr_name, $attr_val) {
    if (property_exists( __CLASS__, $attr_name)) {
      $this->$attr_name=$attr_val; 
      return $this->$attr_name;
    } 
    $emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
    throw new Exception($emess, 45);
    
  }

	public function save() {
    if (!isset($this->id_jeu)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }

	public function update() {
    
    if (!isset($this->id_jeu)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_jeu set id_nom_jeu=".(isset($this->id_nom_jeu) ? "'$this->id_nom_jeu'" : "null")."
									".(isset($this->id_plateforme) ? ",id_plateforme='$this->id_plateforme'" : "").",
									id_type_jeu=".(isset($this->id_type_jeu) ? "'$this->id_type_jeu'" : "null").",
									id_groupe=".(isset($this->id_groupe) ? "'$this->id_groupe'" : "null").",
									id_developpeur=".(isset($this->id_developpeur) ? "'$this->id_developpeur'" : "0").",
									nombre_joueurs=".(isset($this->nombre_joueurs) ? "'$this->nombre_joueurs'" : "0").",
									jeu_valide=".(isset($this->jeu_valide) ? "'$this->jeu_valide'" : "0").",
									remarque_jeu=".(isset($this->remarque_jeu) ? "'$this->remarque_jeu'" : "")."
				where id_jeu=$this->id_jeu;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }

	public function delete() {
     $query = "DELETE FROM bddjv_jeu WHERE id_jeu =".$this->id_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
	public static function validerJeu($id) {
     $query = "UPDATE bddjv_jeu SET jeu_valide='1' WHERE id_jeu =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
	public static function supprimerJeu($id) {
	$db = Base::getConnection();
	$query = 'SELECT photo_boite, photo_loose, photo_notice, photo_dos_boite
	FROM bddjv_version_jeu 
	WHERE id_jeu='.$id;
	foreach($db->query($query) as $row)
	{
		if($row['photo_boite']!="" && $row['photo_boite']!="img/inconnu.png")
		{
			unlink($row['photo_boite']);
		}
		if($row['photo_dos_boite']!="" && $row['photo_dos_boite']!="img/inconnu.png")
		{
			unlink($row['photo_dos_boite']);
		}
		if($row['photo_loose']!="" && $row['photo_loose']!="img/inconnu.png")
		{
			unlink($row['photo_loose']);
		}
		if($row['photo_notice']!="" && $row['photo_notice']!="img/inconnu.png")
		{
			unlink($row['photo_notice']);
		}
	}
	 $db = Base::getConnection();
     $query = "DELETE FROM bddjv_jeu_inclus_accessoire NATURAL JOIN version_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_console_inclus_jeu NATURAL JOIN version_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_version_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_autre_nom_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_autre_plateforme_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_commande_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_langue_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_rapport_jeu WHERE id_jeu =".$id;
	 $db->exec($query);
	}
								
	public function insert() {
  
  	$query = "INSERT INTO bddjv_jeu VALUES (null, '".$this->id_nom_jeu."','".$this->id_plateforme."','".$this->id_type_jeu."','".$this->id_groupe."','".$this->id_developpeur."','".$this->nombre_joueurs."','".$this->jeu_valide."','".$this->remarque_jeu."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_jeu' , $db->LastInsertId() );
	return $db->LastInsertId();
  }
		
    public static function findById($id_jeu) {
	  
	  $query = "select * from bddjv_jeu where id_jeu=".$id_jeu;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      $b=null;
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  if($d!=null)
	  {
		  $b = new self();
		  $b->setAttr('id_jeu', $d->id_jeu);
		  $b->setAttr('id_nom_jeu', $d->id_nom_jeu);
		  $b->setAttr('id_type_jeu', $d->id_type_jeu);
		  $b->setAttr('id_groupe', $d->id_groupe);
		  $b->setAttr('id_developpeur', $d->id_developpeur);
		  $b->setAttr('nombre_joueurs', $d->nombre_joueurs);
		  $b->setAttr('jeu_valide', $d->jeu_valide);
		  $b->setAttr('id_plateforme', $d->id_plateforme);
		  $b->setAttr('remarque_jeu', $d->remarque_jeu);
	  }
	  return $b;
    }
	
	public static function connect($id_nom_jeu, $id_plateforme) {
	$tab=array();
	  $query = "select * from bddjv_jeu where id_nom_jeu='".$id_nom_jeu."' and id_plateforme='".$id_plateforme."';";
      $pdo = Base::getConnection();
	  
	  foreach($pdo->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
			$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nombre_joueurs',$row['nombre_joueurs']);
			$temp->setAttr('jeu_valide',$row['jeu_valide']);
			$temp->setAttr('remarque_jeu',$row['remarque_jeu']);
			$tab[] = $temp;
		}
		return $tab;
	  
    }

    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_jeu ORDER BY id_jeu';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
			$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nombre_joueurs',$row['nombre_joueurs']);
			$temp->setAttr('jeu_valide',$row['jeu_valide']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('remarque_jeu',$row['remarque_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findAllDetails() {
	$tab = array();
	$db = Base::getConnection();
	$query = 'SELECT *
	FROM bddjv_jeu
	NATURAL JOIN bddjv_nom_jeu
	NATURAL JOIN bddjv_groupe
	NATURAL JOIN bddjv_type_jeu
	NATURAL JOIN bddjv_developpeur
	NATURAL JOIN bddjv_version_jeu
	NATURAL JOIN bddjv_region
	NATURAL JOIN bddjv_edition
	NATURAL JOIN bddjv_editeur
	NATURAL JOIN bddjv_support
	NATURAL JOIN bddjv_format
	NATURAL JOIN bddjv_langue_jeu
	NATURAL JOIN bddjv_langues
	JOIN bddjv_plateforme
	WHERE bddjv_plateforme.id_plateforme = bddjv_jeu.id_plateforme';
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_jeu']]))
			{
				$temp = $tab[$row['id_jeu']]; 
				if(!isset($t2['nom_region'][$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divregion" id="Region'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_region'][$row['nom_region']]=1;
				} 
				if(!isset($t2['nom_edition'][$row['nom_edition']]))
				{
					$temp['nom_edition']=$temp['nom_edition'].' / <span class="divedition" id="Edition'.str_replace(' ','_',$row['nom_edition']).'" name="'.$row['nom_edition'].'">'.$row['nom_edition'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_edition'][$row['nom_edition']]=1;
				} 
				if(!isset($t2['nom_support'][$row['nom_support']]))
				{
					$temp['nom_support']=$temp['nom_support'].' / <span class="divsupport" id="Support'.str_replace(' ','_',$row['nom_support']).'" name="'.$row['nom_support'].'">'.$row['nom_support'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_support'][$row['nom_support']]=1;
				} 
				if(!isset($t2['nom_format'][$row['nom_format']]))
				{
					$temp['nom_format']=$temp['nom_format'].' / <span class="divformat" id="Format'.str_replace(' ','_',$row['nom_format']).'" name="'.$row['nom_format'].'">'.$row['nom_format'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_format'][$row['nom_format']]=1;
				} 
				if(!isset($t2['nom_editeur'][$row['nom_editeur']]))
				{
					$temp['nom_editeur']=$temp['nom_editeur'].' / <span class="divediteur" id="Editeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_editeur'][$row['nom_editeur']]=1;
				} 
				if(!isset($t2['nom_langue'][$row['nom_langue']]))
				{
					$temp['nom_langue']=$temp['nom_langue'].' / <span class="divlangue" id="Langue'.str_replace(' ','_',$row['nom_langue']).'" name="'.$row['nom_langue'].'">'.$row['nom_langue'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_langue'][$row['nom_langue']]=1;
				}
				$tab[$row['id_jeu']] = $temp;
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['nom_jeu']=$row['nom_jeu'];
				$temp['id_jeu']=$row['id_jeu'];
				$temp['nom_plateforme']='<span class="divplateforme" id="'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nombre_joueurs']='<span class="divjoueurs" id="'.str_replace(' ','_',$row['nombre_joueurs']).'" name="'.$row['nombre_joueurs'].'">'.$row['nombre_joueurs'];
				$temp['nom_groupe']='<span class="divgroupe" id="'.str_replace(' ','_',$row['nom_groupe']).'" name="'.$row['nom_groupe'].'">'.$row['nom_groupe'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_developpeur']='<span class="divdeveloppeur" id="'.str_replace(' ','_',$row['nom_developpeur']).'" name="'.$row['nom_developpeur'].'">'.$row['nom_developpeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_type_jeu']='<span class="divtype" id="'.str_replace(' ','_',$row['nom_type_jeu']).'" name="'.$row['nom_type_jeu'].'">'.$row['nom_type_jeu'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_region']=array();
				$t2['nom_region'][$row['nom_region']]=1;
				$temp['nom_region']='<span class="divregion" id="Region'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_edition']=array();
				$t2['nom_edition'][$row['nom_edition']]=1;
				$temp['nom_edition']='<span class="divedition" id="Edition'.str_replace(' ','_',$row['nom_edition']).'" name="'.$row['nom_edition'].'">'.$row['nom_edition'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_support']=array();
				$t2['nom_support'][$row['nom_support']]=1;
				$temp['nom_support']='<span class="divsupport" id="Support'.str_replace(' ','_',$row['nom_support']).'" name="'.$row['nom_support'].'">'.$row['nom_support'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_format']=array();
				$t2['nom_format'][$row['nom_format']]=1;
				$temp['nom_format']='<span class="divformat" id="Format'.str_replace(' ','_',$row['nom_format']).'" name="'.$row['nom_format'].'">'.$row['nom_format'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_editeur']=array();
				$t2['nom_editeur'][$row['nom_editeur']]=1;
				$temp['nom_editeur']='<span class="divediteur" id="Editeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_langue']=array();
				$t2['nom_langue'][$row['nom_langue']]=1;
				$temp['nom_langue']='<span class="divlangue" id="'.str_replace(' ','_',$row['nom_langue']).'" name="'.$row['nom_langue'].'">'.$row['nom_langue'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$query2 = 'SELECT *
				FROM bddjv_autre_plateforme_jeu
				NATURAL JOIN bddjv_plateforme
				WHERE id_jeu='.$row['id_jeu'];
				foreach($db->query($query2) as $rowP)
				{
					if(!isset($t2['nom_autre_plateforme'])) 
					{
						$t2['nom_autre_plateforme']=array();
						$t2['nom_autre_plateforme'][$rowP['nom_plateforme']]=1;
						$temp['nom_autre_plateforme']='<span class="divautreplateforme" id="Plateforme'.str_replace(' ','_',$rowP['nom_plateforme']).'" name="'.$rowP['nom_plateforme'].'">'.$rowP['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					}
					else if(!isset($t2['nom_autre_plateforme'][$rowP['nom_autre_plateforme']]))
					{
						$temp['nom_autre_plateforme']=$temp['nom_autre_plateforme'].' / <span class="divautreplateforme" id="Plateforme'.str_replace(' ','_',$rowP['nom_plateforme']).'" name="'.$rowP['nom_plateforme'].'">'.$rowP['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
						$t2['nom_autre_plateforme'][$rowP['nom_plateforme']]=1;
					}
				}
				
				$query2 = 'SELECT *
				FROM bddjv_commande_jeu
				NATURAL JOIN bddjv_commande
				WHERE id_jeu='.$row['id_jeu'];
				foreach($db->query($query2) as $row)
				{
					if(!isset($t2['nom_commande'])) 
					{
						$t2['nom_commande']=array();
						$t2['nom_commande'][$row['nom_commande']]=1;
						$temp['nom_commande']='<span class="divcommande" id="Commande'.str_replace(' ','_',$row['nom_commande']).'" name="'.$row['nom_commande'].'">'.$row['nom_commande'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					}
					else if(!isset($t2['nom_commande'][$row['nom_commande']]))
					{
						$temp['nom_commande']=$temp['nom_commande'].' / <span class="divcommande" id="Commande'.str_replace(' ','_',$row['nom_commande']).'" name="'.$row['nom_commande'].'">'.$row['nom_commande'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
						$t2['nom_commande'][$row['nom_commande']]=1;
					}
				}
				$tab[$row['id_jeu']] = $temp;
			}
		}
		return $tab;
    }
	
	public static function findAllDetailsByPlateforme($id) {
	$tab = array();
	$db = Base::getConnection();
	$query = 'SELECT *
	FROM bddjv_jeu
	NATURAL JOIN bddjv_nom_jeu
	NATURAL JOIN bddjv_groupe
	NATURAL JOIN bddjv_type_jeu
	NATURAL JOIN bddjv_developpeur
	NATURAL JOIN bddjv_version_jeu
	NATURAL JOIN bddjv_region
	NATURAL JOIN bddjv_edition
	NATURAL JOIN bddjv_editeur
	NATURAL JOIN bddjv_support
	NATURAL JOIN bddjv_format
	NATURAL JOIN bddjv_langue_jeu
	NATURAL JOIN bddjv_langues
	JOIN bddjv_plateforme
	WHERE bddjv_plateforme.id_plateforme = bddjv_jeu.id_plateforme
	AND bddjv_plateforme.id_plateforme ='.$id.'
	ORDER BY id_jeu';
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_jeu']]))
			{
				$temp = $tab[$row['id_jeu']]; 
				if(!isset($t2['nom_region'][$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divregion" id="Region'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_region'][$row['nom_region']]=1;
				} 
				if(!isset($t2['nom_edition'][$row['nom_edition']]))
				{
					$temp['nom_edition']=$temp['nom_edition'].' / <span class="divedition" id="Edition'.str_replace(' ','_',$row['nom_edition']).'" name="'.$row['nom_edition'].'">'.$row['nom_edition'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_edition'][$row['nom_edition']]=1;
				} 
				if(!isset($t2['nom_support'][$row['nom_support']]))
				{
					$temp['nom_support']=$temp['nom_support'].' / <span class="divsupport" id="Support'.str_replace(' ','_',$row['nom_support']).'" name="'.$row['nom_support'].'">'.$row['nom_support'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_support'][$row['nom_support']]=1;
				} 
				if(!isset($t2['nom_format'][$row['nom_format']]))
				{
					$temp['nom_format']=$temp['nom_format'].' / <span class="divformat" id="Format'.str_replace(' ','_',$row['nom_format']).'" name="'.$row['nom_format'].'">'.$row['nom_format'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_format'][$row['nom_format']]=1;
				} 
				if(!isset($t2['nom_editeur'][$row['nom_editeur']]))
				{
					$temp['nom_editeur']=$temp['nom_editeur'].' / <span class="divediteur" id="Editeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_editeur'][$row['nom_editeur']]=1;
				} 
				if(!isset($t2['nom_langue'][$row['nom_langue']]))
				{
					$temp['nom_langue']=$temp['nom_langue'].' / <span class="divlangue" id="Langue'.str_replace(' ','_',$row['nom_langue']).'" name="'.$row['nom_langue'].'">'.$row['nom_langue'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_langue'][$row['nom_langue']]=1;
				}
				$tab[$row['id_jeu']] = $temp;
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['nom_jeu']=$row['nom_jeu'];
				$temp['id_jeu']=$row['id_jeu'];
				$temp['nom_plateforme']='<span class="divplateforme" id="Plateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nombre_joueurs']='<span class="divjoueurs" id="Joueurs'.str_replace(' ','_',$row['nombre_joueurs']).'" name="'.$row['nombre_joueurs'].'">'.$row['nombre_joueurs'];
				$temp['nom_groupe']='<span class="divgroupe" id="Groupe'.str_replace(' ','_',$row['nom_groupe']).'" name="'.$row['nom_groupe'].'">'.$row['nom_groupe'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_developpeur']='<span class="divdeveloppeur" id="Developpeur'.str_replace(' ','_',$row['nom_developpeur']).'" name="'.$row['nom_developpeur'].'">'.$row['nom_developpeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_type_jeu']='<span class="divtype" id="Type'.str_replace(' ','_',$row['nom_type_jeu']).'" name="'.$row['nom_type_jeu'].'">'.$row['nom_type_jeu'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_region']=array();
				$t2['nom_region'][$row['nom_region']]=1;
				$temp['nom_region']='<span class="divregion" id="Region'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_edition']=array();
				$t2['nom_edition'][$row['nom_edition']]=1;
				$temp['nom_edition']='<span class="divedition" id="Edition'.str_replace(' ','_',$row['nom_edition']).'" name="'.$row['nom_edition'].'">'.$row['nom_edition'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_support']=array();
				$t2['nom_support'][$row['nom_support']]=1;
				$temp['nom_support']='<span class="divsupport" id="Support'.str_replace(' ','_',$row['nom_support']).'" name="'.$row['nom_support'].'">'.$row['nom_support'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_format']=array();
				$t2['nom_format'][$row['nom_format']]=1;
				$temp['nom_format']='<span class="divformat" id="Format'.str_replace(' ','_',$row['nom_format']).'" name="'.$row['nom_format'].'">'.$row['nom_format'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_editeur']=array();
				$t2['nom_editeur'][$row['nom_editeur']]=1;
				$temp['nom_editeur']='<span class="divediteur" id="Editeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_langue']=array();
				$t2['nom_langue'][$row['nom_langue']]=1;
				$temp['nom_langue']='<span class="divlangue" id="Langue'.str_replace(' ','_',$row['nom_langue']).'" name="'.$row['nom_langue'].'">'.$row['nom_langue'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$query2 = 'SELECT *
				FROM bddjv_autre_plateforme_jeu
				NATURAL JOIN bddjv_plateforme
				WHERE id_jeu='.$row['id_jeu'];
				foreach($db->query($query2) as $rowP)
				{
					if(!isset($t2['nom_autre_plateforme'])) 
					{
						$t2['nom_autre_plateforme']=array();
						$t2['nom_autre_plateforme'][$rowP['nom_plateforme']]=1;
						$temp['nom_autre_plateforme']='<span class="divautreplateforme" id="Plateforme'.str_replace(' ','_',$rowP['nom_plateforme']).'" name="'.$rowP['nom_plateforme'].'">'.$rowP['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					}
					else if(!isset($t2['nom_autre_plateforme'][$rowP['nom_autre_plateforme']]))
					{
						$temp['nom_autre_plateforme']=$temp['nom_autre_plateforme'].' / <span class="divautreplateforme" id="Plateforme'.str_replace(' ','_',$rowP['nom_plateforme']).'" name="'.$rowP['nom_plateforme'].'">'.$rowP['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
						$t2['nom_autre_plateforme'][$rowP['nom_plateforme']]=1;
					}
				}
				
				$query2 = 'SELECT *
				FROM bddjv_commande_jeu
				NATURAL JOIN bddjv_commande
				WHERE id_jeu='.$row['id_jeu'];
				foreach($db->query($query2) as $row)
				{
					if(!isset($t2['nom_commande'])) 
					{
						$t2['nom_commande']=array();
						$t2['nom_commande'][$row['nom_commande']]=1;
						$temp['nom_commande']='<span class="divcommande" id="Commande'.str_replace(' ','_',$row['nom_commande']).'" name="'.$row['nom_commande'].'">'.$row['nom_commande'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					}
					else if(!isset($t2['nom_commande'][$row['nom_commande']]))
					{
						$temp['nom_commande']=$temp['nom_commande'].' / <span class="divcommande" id="Commande'.str_replace(' ','_',$row['nom_commande']).'" name="'.$row['nom_commande'].'">'.$row['nom_commande'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
						$t2['nom_commande'][$row['nom_commande']]=1;
					}
				}
				$tab[$row['id_jeu']] = $temp;
			}
			
		}
		return $tab;

    }
	
	public static function findAllDetailsLiteByPlateforme($id) {
	$tab = array();
	$db = Base::getConnection();
	$query = 'SELECT *
	FROM bddjv_jeu
	NATURAL JOIN bddjv_nom_jeu
	WHERE id_plateforme ='.$id.'
	ORDER BY nom_jeu';
		foreach($db->query($query) as $row)
		{
			$temp = array();
			$temp['nom_jeu']=$row['nom_jeu'];
			$temp['id_jeu']=$row['id_jeu'];
			$tab[$row['id_jeu']] = $temp;
		}
		return $tab;
    }
	public static function findAllDetailsBySearch($nom, $plat, $dev, $type, $groupe, $region, $edition, $editeur, $support, $format, $langue, $commande, $autre_plateforme) 
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT *
		FROM bddjv_jeu
		NATURAL JOIN bddjv_nom_jeu
		NATURAL JOIN bddjv_groupe
		NATURAL JOIN bddjv_type_jeu
		NATURAL JOIN bddjv_developpeur
		NATURAL JOIN bddjv_version_jeu
		NATURAL JOIN bddjv_region
		NATURAL JOIN bddjv_edition
		NATURAL JOIN bddjv_editeur
		NATURAL JOIN bddjv_support
		NATURAL JOIN bddjv_format
		NATURAL JOIN bddjv_langue_jeu
		NATURAL JOIN bddjv_langues
		JOIN bddjv_plateforme
		WHERE bddjv_plateforme.id_plateforme = bddjv_jeu.id_plateforme
		AND nom_jeu LIKE "%'.$nom.'%"'
		.(count($plat)>0?' AND bddjv_jeu.id_plateforme IN('.implode(",",$plat).")":'')
		.(count($dev)>0?' AND id_developpeur IN('.implode(",",$dev).")":'')
		.(count($type)>0?' AND id_type_jeu IN('.implode(",",$type).")":'')
		.(count($groupe)>0?' AND id_groupe IN('.implode(",",$groupe).")":'')
		.(count($region)>0?' AND id_region IN('.implode(",",$region).")":'')
		.(count($edition)>0?' AND id_edition IN('.implode(",",$edition).")":'')
		.(count($editeur)>0?' AND bddjv_version_jeu.id_editeur IN('.implode(",",$editeur).")":'')
		.(count($support)>0?' AND id_support IN('.implode(",",$support).")":'')
		.(count($format)>0?' AND id_format IN('.implode(",",$format).")":'')
		.(count($langue)>0?' AND id_langue IN('.implode(",",$langue).")":'')
		.(count($commande)>0?' AND id_jeu IN(
		SELECT id_jeu
		FROM bddjv_commande_jeu
		WHERE id_commande IN('.implode(",",$commande).")
		)":'')
		.(count($autre_plateforme)>0?' AND id_jeu IN(
		SELECT id_jeu
		FROM bddjv_autre_plateforme_jeu
		WHERE id_plateforme IN('.implode(",",$autre_plateforme).")
		)":'');
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_jeu']]))
			{
				$temp = $tab[$row['id_jeu']]; 
				if(!isset($t2['nom_region'][$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divregion" id="Region'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_region'][$row['nom_region']]=1;
				} 
				if(!isset($t2['nom_edition'][$row['nom_edition']]))
				{
					$temp['nom_edition']=$temp['nom_edition'].' / <span class="divedition" id="Edition'.str_replace(' ','_',$row['nom_edition']).'" name="'.$row['nom_edition'].'">'.$row['nom_edition'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_edition'][$row['nom_edition']]=1;
				} 
				if(!isset($t2['nom_support'][$row['nom_support']]))
				{
					$temp['nom_support']=$temp['nom_support'].' / <span class="divsupport" id="Support'.str_replace(' ','_',$row['nom_support']).'" name="'.$row['nom_support'].'">'.$row['nom_support'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_support'][$row['nom_support']]=1;
				} 
				if(!isset($t2['nom_format'][$row['nom_format']]))
				{
					$temp['nom_format']=$temp['nom_format'].' / <span class="divformat" id="Format'.str_replace(' ','_',$row['nom_format']).'" name="'.$row['nom_format'].'">'.$row['nom_format'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_format'][$row['nom_format']]=1;
				} 
				if(!isset($t2['nom_editeur'][$row['nom_editeur']]))
				{
					$temp['nom_editeur']=$temp['nom_editeur'].' / <span class="divediteur" id="Editeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_editeur'][$row['nom_editeur']]=1;
				} 
				if(!isset($t2['nom_langue'][$row['nom_langue']]))
				{
					$temp['nom_langue']=$temp['nom_langue'].' / <span class="divlangue" id="Langue'.str_replace(' ','_',$row['nom_langue']).'" name="'.$row['nom_langue'].'">'.$row['nom_langue'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2['nom_langue'][$row['nom_langue']]=1;
				}
				$tab[$row['id_jeu']] = $temp;
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['nom_jeu']=$row['nom_jeu'];
				$temp['id_jeu']=$row['id_jeu'];
				$temp['nom_plateforme']='<span class="divplateforme" id="'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nombre_joueurs']='<span class="divjoueurs" id="'.str_replace(' ','_',$row['nombre_joueurs']).'" name="'.$row['nombre_joueurs'].'">'.$row['nombre_joueurs'];
				$temp['nom_groupe']='<span class="divgroupe" id="'.str_replace(' ','_',$row['nom_groupe']).'" name="'.$row['nom_groupe'].'">'.$row['nom_groupe'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_developpeur']='<span class="divdeveloppeur" id="'.str_replace(' ','_',$row['nom_developpeur']).'" name="'.$row['nom_developpeur'].'">'.$row['nom_developpeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_type_jeu']='<span class="divtype" id="'.str_replace(' ','_',$row['nom_type_jeu']).'" name="'.$row['nom_type_jeu'].'">'.$row['nom_type_jeu'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_region']=array();
				$t2['nom_region'][$row['nom_region']]=1;
				$temp['nom_region']='<span class="divregion" id="Region'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_edition']=array();
				$t2['nom_edition'][$row['nom_edition']]=1;
				$temp['nom_edition']='<span class="divedition" id="Edition'.str_replace(' ','_',$row['nom_edition']).'" name="'.$row['nom_edition'].'">'.$row['nom_edition'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_support']=array();
				$t2['nom_support'][$row['nom_support']]=1;
				$temp['nom_support']='<span class="divsupport" id="Support'.str_replace(' ','_',$row['nom_support']).'" name="'.$row['nom_support'].'">'.$row['nom_support'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_format']=array();
				$t2['nom_format'][$row['nom_format']]=1;
				$temp['nom_format']='<span class="divformat" id="Format'.str_replace(' ','_',$row['nom_format']).'" name="'.$row['nom_format'].'">'.$row['nom_format'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_editeur']=array();
				$t2['nom_editeur'][$row['nom_editeur']]=1;
				$temp['nom_editeur']='<span class="divediteur" id="Editeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2['nom_langue']=array();
				$t2['nom_langue'][$row['nom_langue']]=1;
				$temp['nom_langue']='<span class="divlangue" id="'.str_replace(' ','_',$row['nom_langue']).'" name="'.$row['nom_langue'].'">'.$row['nom_langue'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$query2 = 'SELECT *
				FROM bddjv_autre_plateforme_jeu
				NATURAL JOIN bddjv_plateforme
				WHERE id_jeu='.$row['id_jeu'];
				foreach($db->query($query2) as $rowP)
				{
					if(!isset($t2['nom_autre_plateforme'])) 
					{
						$t2['nom_autre_plateforme']=array();
						$t2['nom_autre_plateforme'][$rowP['nom_plateforme']]=1;
						$temp['nom_autre_plateforme']='<span class="divautreplateforme" id="Plateforme'.str_replace(' ','_',$rowP['nom_plateforme']).'" name="'.$rowP['nom_plateforme'].'">'.$rowP['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					}
					else if(!isset($t2['nom_autre_plateforme'][$rowP['nom_autre_plateforme']]))
					{
						$temp['nom_autre_plateforme']=$temp['nom_autre_plateforme'].' / <span class="divautreplateforme" id="Plateforme'.str_replace(' ','_',$rowP['nom_plateforme']).'" name="'.$rowP['nom_plateforme'].'">'.$rowP['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
						$t2['nom_autre_plateforme'][$rowP['nom_plateforme']]=1;
					}
				}
				
				$query2 = 'SELECT *
				FROM bddjv_commande_jeu
				NATURAL JOIN bddjv_commande
				WHERE id_jeu='.$row['id_jeu'];
				foreach($db->query($query2) as $row)
				{
					if(!isset($t2['nom_commande'])) 
					{
						$t2['nom_commande']=array();
						$t2['nom_commande'][$row['nom_commande']]=1;
						$temp['nom_commande']='<span class="divcommande" id="Commande'.str_replace(' ','_',$row['nom_commande']).'" name="'.$row['nom_commande'].'">'.$row['nom_commande'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					}
					else if(!isset($t2['nom_commande'][$row['nom_commande']]))
					{
						$temp['nom_commande']=$temp['nom_commande'].' / <span class="divcommande" id="Commande'.str_replace(' ','_',$row['nom_commande']).'" name="'.$row['nom_commande'].'">'.$row['nom_commande'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
						$t2['nom_commande'][$row['nom_commande']]=1;
					}
				}
				$tab[$row['id_jeu']] = $temp;
			}
		}
		return $tab;
    }
	
	public static function findDetails($id) {
			$temp['id_plateforme']=0;
	$db = Base::getConnection();
	$query = 'SELECT *
	FROM bddjv_jeu
	NATURAL JOIN bddjv_nom_jeu
	NATURAL JOIN bddjv_plateforme
	NATURAL JOIN bddjv_groupe
	NATURAL JOIN bddjv_type_jeu
	NATURAL JOIN bddjv_developpeur
	WHERE id_jeu='.$id;
		foreach($db->query($query) as $row)
		{
			$temp = array();
	  		$temp['id_jeu']=$row['id_jeu'];
	  		$temp['nom_jeu']=$row['nom_jeu'];
	  		$temp['nom_plateforme']=$row['nom_plateforme'];
	  		$temp['id_plateforme']=$row['id_plateforme'];
	  		$temp['logo_plateforme']=$row['logo_plateforme'];
	  		$temp['nom_groupe']=$row['nom_groupe'];
	  		$temp['logo_groupe']=$row['logo_groupe'];
	  		$temp['nom_developpeur']=$row['nom_developpeur'];
	  		$temp['logo_developpeur']=$row['logo_developpeur'];
	  		$temp['nom_type']=$row['nom_type_jeu'];
	  		$temp['logo_type_jeu']=$row['logo_type_jeu'];
	  		$temp['nombre_joueurs']=$row['nombre_joueurs'];
	  		$temp['jeu_valide']=$row['jeu_valide'];
			$temp['remarque_jeu']=$row['remarque_jeu'];
		}
		$query = 'SELECT *
	FROM bddjv_editeur
	NATURAL JOIN bddjv_plateforme
	WHERE id_plateforme='.$temp['id_plateforme'];
		foreach($db->query($query) as $row)
		{
	  		$temp['nom_editeur_plateforme']=$row['nom_editeur'];
	  		$temp['id_editeur_plateforme']=$row['id_editeur'];
	  		$temp['logo_editeur_plateforme']=$row['logo_editeur'];
		}	
	$query = 'SELECT *
	FROM bddjv_autre_plateforme_jeu
	NATURAL JOIN bddjv_plateforme
	WHERE id_jeu='.$id;
	$temp['autres_plateformes'] = array();
	foreach($db->query($query) as $row)
	{
		$temp2 = array();
		$temp2['nom_plateforme'] = $row['nom_plateforme'];
		$temp2['logo_plateforme'] = $row['logo_plateforme'];
		$temp['autres_plateformes'][] = $temp2;
	}
	
	$query = 'SELECT *
	FROM bddjv_commande_jeu
	NATURAL JOIN bddjv_commande
	WHERE id_jeu='.$id;
	$temp['commande'] = array();
	foreach($db->query($query) as $row)
	{
		$temp2 = array();
		$temp2['nom_commande'] = $row['nom_commande'];
		$temp2['logo_commande'] = $row['logo_commande'];
		$temp['commande'][] = $temp2;
	}
	
	return $temp;

    }
	
	public static function findByName($id_nom_jeu) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_jeu where id_nom_jeu='".$id_nom_jeu."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
			$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nombre_joueurs',$row['nombre_joueurs']);
			$temp->setAttr('jeu_valide',$row['jeu_valide']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp['remarque_jeu']=$row['remarque_jeu'];
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findByKeys($nom, $plateforme) {
		$db = Base::getConnection();
		$query = 'SELECT *
		FROM bddjv_jeu
		NATURAL JOIN bddjv_nom_jeu
		NATURAL JOIN bddjv_plateforme
		WHERE nom_plateforme="'.$plateforme.'"
		AND nom_jeu="'.$nom.'";';
		$temp = array();
		foreach($db->query($query) as $row)
		{
				$temp[]=$row['id_jeu'];
		}
			
		return $temp;
	}
	
	public static function findAllNames() {
		$db = Base::getConnection();
		$query = 'SELECT *
		FROM bddjv_jeu
		NATURAL JOIN bddjv_nom_jeu
		JOIN bddjv_plateforme 
		WHERE bddjv_jeu.id_plateforme = bddjv_plateforme.id_plateforme
		ORDER BY nom_plateforme, nom_jeu;';
		$temp = array();
		foreach($db->query($query) as $row)
		{
			$temp2 = array();
			$temp2['id']=$row['id_jeu'];
			$temp2['nom']=$row['nom_jeu']." (".$row['nom_plateforme'].")";
			$temp[]=$temp2;
		}
			
		return $temp;
	}
	
	public static function findDuplicates($id_nom_jeu, $id_plateforme) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_jeu where id_nom_jeu='".$id_nom_jeu."' and id_plateforme='".$id_plateforme."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
			$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nombre_joueurs',$row['nombre_joueurs']);
			$temp->setAttr('jeu_valide',$row['jeu_valide']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('remarque_jeu',$row['remarque_jeu']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findIncompletes() {
	$tab = array();
	$db = Base::getConnection();
	$query = 'SELECT *
	FROM bddjv_jeu
	NATURAL JOIN bddjv_nom_jeu
	NATURAL JOIN bddjv_groupe
	NATURAL JOIN bddjv_type_jeu
	NATURAL JOIN bddjv_developpeur
	NATURAL JOIN bddjv_plateforme
	where id_nom_jeu=0 
	 or id_type_jeu=0 
	 or id_groupe=0 
	 or id_developpeur=0 
	 or id_plateforme=0 
	 or nombre_joueurs=0
	 LIMIT 501';
		foreach($db->query($query) as $row)
		{
				$temp = array();
				$temp['id_jeu']=$row['id_jeu'];
				$temp['nom_jeu']=$row['nom_jeu'];
				$temp['nom_plateforme']=$row['nom_plateforme'];
				$temp['nombre_joueurs']=$row['nombre_joueurs'];
				$temp['nom_groupe']=$row['nom_groupe'];
				$temp['nom_developpeur']=$row['nom_developpeur'];
				$temp['nom_type']=$row['nom_type_jeu'];
				$temp['remarque_jeu']=$row['remarque_jeu'];
				$tab[$row['id_jeu']] = $temp;
		}
		return $tab;

    }
	
	public static function findAutocompleteValues() {
	$tab = array();
	$db = Base::getConnection();
	$query = 'SELECT *
	FROM bddjv_jeu
	NATURAL JOIN bddjv_nom_jeu
	NATURAL JOIN bddjv_plateforme';
		foreach($db->query($query) as $row)
		{
				$tab[] = $row['nom_jeu'].' ('.$row['nom_plateforme'].')';
		}
		return $tab;

    }
	
	public static function findMissingInformations() {
		$db = Base::getConnection();
		$tab = array();
		$tab['plateforme'] = array();
		$tab['developpeur']= array();
		$tab['type_jeu']= array();
		$tab['groupe']= array();
		$tab['nom_jeu']= array();
		$tab['version_jeu']= array();
		$tab['region']= array();
		$tab['edition']= array();
		$tab['editeur']= array();
		$tab['support']= array();
		$tab['format']= array();
		$tab['langues']= array();
		$tab['langue_jeu']= array();
		$tab['commande']= array();
		$tab['commande_jeu']= array();
		$tab['autre_plaetforme']= array();
		
		$query = "SELECT *
				FROM bddjv_jeu 
				WHERE id_jeu NOT IN
			(
				SELECT id_jeu
				FROM bddjv_jeu
				NATURAL JOIN bddjv_plateforme
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['plateforme'][$row['id_plateforme']]= $row['id_jeu'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				WHERE id_jeu NOT IN
			(
				SELECT id_jeu
				FROM bddjv_jeu
				NATURAL JOIN bddjv_developpeur
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['developpeur'][$row['id_developpeur']]= $row['id_jeu'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				WHERE id_jeu NOT IN
			(
				SELECT id_jeu
				FROM bddjv_jeu
				NATURAL JOIN bddjv_type_jeu
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['type_jeu'][$row['id_type_jeu']]= $row['id_jeu'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				WHERE id_jeu NOT IN
			(
				SELECT id_jeu
				FROM bddjv_jeu
				NATURAL JOIN bddjv_nom_jeu
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['nom_jeu'][$row['id_nom_jeu']]= $row['id_jeu'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				WHERE id_jeu NOT IN
			(
				SELECT id_jeu
				FROM bddjv_jeu
				NATURAL JOIN bddjv_groupe
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['groupe'][$row['id_groupe']]= $row['id_jeu'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				WHERE id_jeu NOT IN
			(
				SELECT id_jeu
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['version_jeu'][$row['id_version']]= $row['id_jeu'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				NATURAL JOIN bddjv_version_jeu
				WHERE id_version NOT IN
			(
				SELECT id_version
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_region
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['region'][$row['id_region']]= $row['id_version'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				NATURAL JOIN bddjv_version_jeu
				WHERE id_version NOT IN
			(
				SELECT id_version
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_edition
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['edition'][$row['id_edition']]= $row['id_version'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				NATURAL JOIN bddjv_version_jeu
				WHERE id_version NOT IN
			(
				SELECT id_version
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_editeur
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['editeur'][$row['id_editeur']]= $row['id_version'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				NATURAL JOIN bddjv_version_jeu
				WHERE id_version NOT IN
			(
				SELECT id_version
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_support
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['support'][$row['id_support']]= $row['id_version'];
		}
		$query = "SELECT *
				FROM bddjv_jeu 
				NATURAL JOIN bddjv_version_jeu
				WHERE id_version NOT IN
			(
				SELECT id_version
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_langue_jeu
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['langue_jeu'][$row['id_langue']]= $row['id_jeu'];
		}		
		$query = "SELECT *
				FROM bddjv_jeu 
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_langue_jeu
				WHERE id_version NOT IN
			(
				SELECT id_version
				FROM bddjv_jeu
				NATURAL JOIN bddjv_version_jeu
				NATURAL JOIN bddjv_langue_jeu
				NATURAL JOIN bddjv_langues
			)";
	
		foreach($db->query($query) as $row)
		{
			$tab['langues'][$row['id_langue']]= $row['id_version'];
		}
		return $tab;
	}

	public static function findInvalide() {
	  
	  $query = "select id_jeu from bddjv_jeu where jeu_valide=0
	  LIMIT 201";
      $pdo = Base::getConnection();
	  $tab = array();
      $b=null;
	  foreach($pdo->query($query) as $row)
	  {
		  $b = new self();
		  $b->setAttr('id_jeu', $row[id_jeu]);
		  $tab[]=$b;
	  }
	  return $tab;
    }

}
?>