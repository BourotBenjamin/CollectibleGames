<?php

class details_jeu {


  private $id_version; 
  private $id_jeu;
  private $id_region;
  private $id_edition;
  private $photo_boite;
  private $photo_dos_boite;
  private $photo_loose;
  private $photo_notice;
  private $reference_jeu;
  private $id_editeur;
  private $code_barre_jeu;
  private $version_jeu_valide;
  private $date_sortie_jeu;
  private $id_support;
  private $id_format;
  private $remarque_version_jeu;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_version : ". $this->id_version . "
				   id_jeu  ". $this->id_jeu  ."
				   id_region  ". $this->id_region  ."
				   id_edition ". $this->id_edition."
				   photo_boite ". $this->photo_boite."
				   photo_dos_boite ". $this->photo_dos_boite."
				   photo_notice ". $this->photo_notice."
				   reference_jeu ". $this->reference_jeu."
				   id_editeur ". $this->id_editeur."
				   photo_loose ". $this->photo_loose."
				   code_barre_jeu ". $this->code_barre_jeu."
				   version_jeu_valide ". $this->version_jeu_valide."
				   date_sortie_jeu  ". $this->date_sortie_jeu."
				   id_support  ". $this->id_support."
				   id_format  ". $this->id_format."
				   remarque_version_jeu  ". $this->remarque_version_jeu;
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
	  if(isset($this->id_version))
	  {
		  $return = $this->update();
	  }
	  else
	  {
		$return =  $this->insert();
		if($return==0) 
		{
		  $return = $this->update();
		}
	  }
      
	return $return;
  }


  public function update() {
    
    if (!isset($this->id_version)) {
      return 0;
    } 
    
    $save_query = "update bddjv_version_jeu set 
									".(isset($this->id_jeu) ? "id_jeu='$this->id_jeu'," : "")."
									".(isset($this->id_region) ? "id_region='$this->id_region'," : "")."
									".(isset($this->id_edition) ? "id_edition='$this->id_edition'," : "")."
									".(isset($this->photo_boite) ? "photo_boite='$this->photo_boite'," : "")."
									".(isset($this->photo_dos_boite) ? "photo_dos_boite='$this->photo_dos_boite'," : "")."
									".(isset($this->photo_notice) ? "photo_notice='$this->photo_notice'," : "")."
									".(isset($this->reference_jeu) ? "reference_jeu='$this->reference_jeu'," : "")."
									".(isset($this->id_editeur) ? "id_editeur='$this->id_editeur'," : "")."
									".(isset($this->photo_loose) ? "photo_loose='$this->photo_loose'," : "")."
									".(isset($this->code_barre_jeu) ? "code_barre_jeu='$this->code_barre_jeu'," : "")."
									".(isset($this->version_jeu_valide) ? "version_jeu_valide='$this->version_jeu_valide'," : "")."
									".(isset($this->date_sortie_jeu) ? "date_sortie_jeu='$this->date_sortie_jeu'," : "")."
									".(isset($this->id_support) ? "id_support='$this->id_support'," : "")."
									".(isset($this->id_format) ? "id_format='$this->id_format'," : "")."
									".(isset($this->remarque_version_jeu) ? "remarque_version_jeu='$this->remarque_version_jeu'," : "")."
				id_version=$this->id_version where id_version=$this->id_version";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_version_jeu WHERE id_version =".$this->id_version;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
	public static function validerVersionJeu($id) {
     $query = "UPDATE bddjv_version_jeu SET version_jeu_valide='1' WHERE id_version =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }	
  
	public static function supprimerVersionJeu($id) {
	$db = Base::getConnection();
	$query = 'SELECT photo_boite, photo_loose, photo_notice, photo_dos_boite
	 FROM bddjv_version_jeu 
	 WHERE id_version='.$id;
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
     $query = "DELETE FROM bddjv_version_jeu WHERE id_version =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_langue_jeu WHERE id_version =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_jeu_inclus_accessoire WHERE id_version =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_console_inclus_jeu WHERE id_version =".$id;
	 $db->exec($query);
	}
								
  public function insert() {
	if($this->photo_boite=="")
	{
		$this->photo_boite="img/inconnu.png";
	}
	if($this->photo_dos_boite=="")
	{
		$this->photo_dos_boite="img/inconnu.png";
	}
	if($this->photo_loose=="")
	{
		$this->photo_loose="img/inconnu.png";
	}
	if($this->photo_notice=="")
	{
		$this->photo_notice="img/inconnu.png";
	}
	$query = "
	SELECT COUNT(*) nb
	FROM bddjv_jeu
	NATURAL JOIN bddjv_version_jeu
	WHERE id_jeu=".$this->id_jeu."
	AND (id_region!=0
	OR id_edition!=0)";
	$db = Base::getConnection();
	foreach($db->query($query) as $row)
	{
		$n = $row['nb'];
	}
	$query = "
	SELECT COUNT(*) nb
	FROM bddjv_jeu
	NATURAL JOIN bddjv_version_jeu
	WHERE id_jeu=".$this->id_jeu;
	foreach($db->query($query) as $row)
	{
		$m = $row['nb'];
	}
  	if($n>0 || $m==0)
	{
		$query = "INSERT INTO bddjv_version_jeu VALUES (null,'".$this->id_jeu."','".$this->id_region."','".$this->id_edition."','".$this->photo_boite."','".$this->photo_dos_boite."','".$this->photo_loose."','".$this->photo_notice."','".$this->reference_jeu."','".$this->id_editeur."','".$this->code_barre_jeu."','".$this->version_jeu_valide."','".$this->date_sortie_jeu."','".$this->id_support."','".$this->id_format."','".$this->remarque_version_jeu."');";
		$nb = $db->exec($query);
		if($db->lastInsertId()!=0)
		{
			$this->setAttr('id_version', $db->lastInsertId());
		}
	}
	else
	{
		$nb=0;
		$query = "SELECT id_version
		FROM bddjv_jeu
		NATURAL JOIN bddjv_version_jeu
		WHERE id_jeu=".$this->id_jeu."
		AND id_region=0
		AND id_edition=0";
		foreach($db->query($query) as $row)
		{
			$this->setAttr('id_version', $row['id_version']);
		}
	}
	return $nb;
  }
		

    public static function findById($id_version) {
	  
	  $query = "select * from bddjv_version_jeu where id_version=".$id_version;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_version', $d->id_version);
	  $b->setAttr('id_region', $d->id_region);
	  $b->setAttr('id_jeu', $d->id_jeu);
	  $b->setAttr('id_edition', $d->id_edition);
	  $b->setAttr('photo_boite', $d->photo_boite);
	  $b->setAttr('photo_dos_boite', $d->photo_dos_boite);
	  $b->setAttr('photo_notice', $d->photo_notice);
	  $b->setAttr('reference_jeu', $d->reference_jeu);
	  $b->setAttr('id_editeur', $d->id_editeur);
	  $b->setAttr('photo_loose', $d->photo_loose);
	  $b->setAttr('code_barre_jeu', $d->code_barre_jeu);
	  $b->setAttr('version_jeu_valide', $d->version_jeu_valide);
	  $b->setAttr('date_sortie_jeu', $d->date_sortie_jeu);
	  $b->setAttr('id_support', $d->id_support);
	  $b->setAttr('id_format', $d->id_format);
	  $b->setAttr('remarque_version_jeu', $d->remarque_version_jeu);
	  
	  return $b;
    }
	
	public static function findByJeu($id_jeu) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT id_version FROM bddjv_version_jeu WHERE id_jeu='.$id_jeu;
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('id_edition',$row['id_edition']);
			$temp->setAttr('photo_boite',$row['photo_boite']);
			$temp->setAttr('photo_dos_boite',$row['photo_dos_boite']);
			$temp->setAttr('photo_notice',$row['photo_notice']);
			$temp->setAttr('reference_jeu',$row['reference_jeu']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('photo_loose',$row['photo_loose']);
			$temp->setAttr('code_barre_jeu',$row['code_barre_jeu']);
			$temp->setAttr('version_jeu_valide',$row['version_jeu_valide']);
			$temp->setAttr('date_sortie_jeu',$row['date_sortie_jeu']);
			$temp->setAttr('id_support',$row['id_support']);
			$temp->setAttr('id_format',$row['id_format']);
			$temp->setAttr('remarque_version_jeu',$row['remarque_version_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_version_jeu ORDER BY id_version DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('id_edition',$row['id_edition']);
			$temp->setAttr('photo_boite',$row['photo_boite']);
			$temp->setAttr('photo_dos_boite',$row['photo_dos_boite']);
			$temp->setAttr('photo_notice',$row['photo_notice']);
			$temp->setAttr('reference_jeu',$row['reference_jeu']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('photo_loose',$row['photo_loose']);
			$temp->setAttr('code_barre_jeu',$row['code_barre_jeu']);
			$temp->setAttr('version_jeu_valide',$row['version_jeu_valide']);
			$temp->setAttr('date_sortie_jeu',$row['date_sortie_jeu']);
			$temp->setAttr('id_support',$row['id_support']);
			$temp->setAttr('id_format',$row['id_format']);
			$temp->setAttr('remarque_version_jeu',$row['remarque_version_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findAllVersions($id) {
	
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM bddjv_version_jeu 
	NATURAL JOIN bddjv_region 
	NATURAL JOIN bddjv_edition
	NATURAL JOIN bddjv_editeur 
	NATURAL JOIN bddjv_support 
	NATURAL JOIN bddjv_format 
	WHERE id_jeu='.$id.' 
	ORDER BY ordre_region DESC, id_edition';
	
		foreach($db->query($query) as $row)
		{
			$temp=array();
	  		$temp['id_version']=$row['id_version'];
	  		$temp['nom_region']=$row['nom_region'];
	  		$temp['logo_region']=$row['logo_region'];
	  		$temp['nom_edition']=$row['nom_edition'];
	  		$temp['logo_edition']=$row['logo_edition'];
	  		$temp['photo_loose']=$row['photo_loose'];
	  		$temp['photo_notice']=$row['photo_notice'];
	  		$temp['photo_boite']=$row['photo_boite'];
	  		$temp['photo_dos_boite']=$row['photo_dos_boite'];
	  		$temp['reference_jeu']=$row['reference_jeu'];
	  		$temp['nom_editeur']=$row['nom_editeur'];
	  		$temp['logo_editeur']=$row['logo_editeur'];
	  		$temp['code_barre_jeu']=$row['code_barre_jeu'];
	  		$temp['version_jeu_valide']=$row['version_jeu_valide'];
	  		$temp['date_sortie_jeu']=$row['date_sortie_jeu'];
	  		$temp['nom_format']=$row['nom_format'];
	  		$temp['logo_format']=$row['logo_format'];
	  		$temp['nom_support']=$row['nom_support'];
	  		$temp['logo_support']=$row['logo_support'];
	  		$temp['remarque_version_jeu']=$row['remarque_version_jeu'];
	  		$temp['autre_nom_jeu']='';
			$query = "select * from bddjv_autre_nom_jeu NATURAL JOIN bddjv_nom_jeu where id_version=".$temp['id_version'];
			foreach($db->query($query) as $row)
			{
				$temp['autre_nom_jeu']=$row['nom_jeu'];
			}
			$query = 'SELECT *
			FROM bddjv_langue_jeu
			NATURAL JOIN bddjv_langues
			WHERE id_version='.$temp['id_version'];
			$temp['langues'] = array();
			foreach($db->query($query) as $row)
			{
				$temp2 = array();
				$temp2['nom_langue'] = $row['nom_langue'];
				$temp2['logo_langue'] = $row['logo_langue'];
				$temp['langues'][] = $temp2;
			}
			$query = 'SELECT *
			FROM bddjv_jeu_inclus_accessoire
			NATURAL JOIN bddjv_accessoire
			NATURAL JOIN bddjv_plateforme
			WHERE id_version='.$temp['id_version'];
			$temp['accessoires'] = array();
			foreach($db->query($query) as $row)
			{
				$temp2 = array();
				$temp2['nom_accessoire'] = $row['nom_accessoire'];
				$temp2['nom_plateforme'] = $row['nom_plateforme'];
				$temp2['id_accessoire'] = $row['id_accessoire'];
				$temp['accessoires'][] = $temp2;
			}
			$tab[] = $temp;
		}
		return $tab;

    }	
	
	public static function findIdVersionByString($id, $string) 
	{
    $n=-1;
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM bddjv_version_jeu 
	NATURAL JOIN bddjv_region 
	NATURAL JOIN bddjv_edition
	WHERE id_jeu='.$id.'
	ORDER BY id_version DESC';
		foreach($db->query($query) as $row)
		{
			if($string=="Region : ".$row['nom_region']." ; Version : ".$row['nom_edition'])
			{
				$n=$row['id_version'];
			}
		}
		return $n;
	}
		
	public static function findIdVersion($id, $edition, $region) {
	
    $n=0;
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM bddjv_version_jeu 
	NATURAL JOIN bddjv_region 
	NATURAL JOIN bddjv_edition
	WHERE id_jeu='.$id.' 
	AND nom_edition="'.$edition.'"
	AND nom_region="'.$region.'" 
	ORDER BY id_version DESC';
	
		foreach($db->query($query) as $row)
		{
	  		$n=$row['id_version'];
		}
		return $n;

    }
	
	public static function findIncompletes() 
	{
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_version_jeu 
	NATURAL JOIN bddjv_region 
	NATURAL JOIN bddjv_edition
	NATURAL JOIN bddjv_editeur 
	NATURAL JOIN bddjv_support 
	NATURAL JOIN bddjv_format 
	WHERE id_region=0  
	OR id_edition=0  
	OR reference_jeu="" 
	OR id_editeur=0  
	OR photo_boite=""  
	OR photo_boite="img/inconnu.png"  
	OR photo_notice=""  
	OR photo_notice="img/inconnu.png" 
	OR photo_loose=""  
	OR photo_loose="img/inconnu.png"
	OR photo_dos_boite=""  
	OR photo_dos_boite="img/inconnu.png"
	OR id_support=0 
	OR id_format=0  
	OR code_barre_jeu=""
	LIMIT 501;';
	
	
		foreach($db->query($query) as $row)
		{
			$temp=array();
	  		$temp['id_jeu']=$row['id_jeu'];
	  		$temp['id_version']=$row['id_version'];
	  		$temp['nom_region']=$row['nom_region'];
	  		$temp['logo_region']=$row['logo_region'];
	  		$temp['nom_edition']=$row['nom_edition'];
	  		$temp['logo_edition']=$row['logo_edition'];
	  		$temp['photo_loose']=$row['photo_loose'];
	  		$temp['photo_notice']=$row['photo_notice'];
	  		$temp['photo_boite']=$row['photo_boite'];
	  		$temp['photo_dos_boite']=$row['photo_dos_boite'];
	  		$temp['reference_jeu']=$row['reference_jeu'];
	  		$temp['nom_editeur']=$row['nom_editeur'];
	  		$temp['logo_editeur']=$row['logo_editeur'];
	  		$temp['code_barre_jeu']=$row['code_barre_jeu'];
	  		$temp['version_jeu_valide']=$row['version_jeu_valide'];
	  		$temp['date_sortie_jeu']=$row['date_sortie_jeu'];
	  		$temp['nom_format']=$row['nom_format'];
	  		$temp['logo_format']=$row['logo_format'];
	  		$temp['nom_support']=$row['nom_support'];
	  		$temp['logo_support']=$row['logo_support'];
	  		$temp['remarque_version_jeu']=$row['remarque_version_jeu'];
	  		$temp['autre_nom_jeu']='';
			$query = "select * from bddjv_autre_nom_jeu NATURAL JOIN bddjv_nom_jeu where id_version=".$temp['id_version'];
			foreach($db->query($query) as $row)
			{
				$temp['autre_nom_jeu']=$row['nom_jeu'];
			}
			$query = 'SELECT *
			FROM bddjv_langue_jeu
			NATURAL JOIN bddjv_langues
			WHERE id_version='.$temp['id_version'];
			$temp['langues'] = array();
			foreach($db->query($query) as $row)
			{
				$temp2 = array();
				$temp2['nom_langue'] = $row['nom_langue'];
				$temp2['logo_langue'] = $row['logo_langue'];
				$temp['langues'][] = $temp2;
			}
			$tab[] = $temp;
		}
		return $tab;
    }
	
	public static function findInvalide() {
	  
	  $query = "select id_jeu, id_version from bddjv_version_jeu where version_jeu_valide=0 LIMIT 201";
      $pdo = Base::getConnection();
	  $tab = array();
      $b=null;
	  foreach($pdo->query($query) as $row)
	  {
		  $b = new self();
		  $b->setAttr('id_jeu', $row[id_jeu]);
		  $b->setAttr('id_version', $row[id_version]);
		  $tab[]=$b;
	  }
	  return $tab;
    }

	public static function countVersions()
	{
	  $query = "select max(id_version) countV from bddjv_version_jeu";
      $pdo = Base::getConnection();
	  foreach($pdo->query($query) as $row)
	  {
		return $row[countV];
	  }
	}
	
	
}
?>