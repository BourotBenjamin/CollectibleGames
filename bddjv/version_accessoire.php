<?php

class version_accessoire {


  private $id_version_accessoire; 
  private $id_accessoire;
  private $id_region;
  private $photo_accessoire; 
  private $date_sortie_accessoire; 
  private $prix_accessoire; 
  private $ref_accessoire; 
  private $version_accessoire_valide; 
  private $remarque_version_accessoire; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_version_accessoire : ". $this->id_version_accessoire . "
					id_accessoire : ". $this->id_accessoire . "
					id_region : ". $this->id_region . "
				   photo_accessoire ". $this->photo_accessoire . "
				   ref_accessoire ". $this->ref_accessoire . "
				   version_accessoire_valide ". $this->version_accessoire_valide . "
				   remarque_version_accessoire ". $this->remarque_version_accessoire;
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
    if (!isset($this->id_version_accessoire)) 
	{
		$nb = $this->insert();
		if($nb==0)
		{
			$nb = $this->update();
		}
    } 
	else 
	{
      $nb = $this->update();
    }
	return $nb;
  }


  public function update() {
    if (!isset($this->id_version_accessoire)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_version_accessoire set id_accessoire=".(isset($this->id_accessoire) ? "'$this->id_accessoire'" : "").",
	".(isset($this->id_region) ?'id_region="'.$this->id_region.'",':"")."
	".(isset($this->photo_accessoire) ? "photo_accessoire='$this->photo_accessoire'," : "")."
	date_sortie_accessoire=".(isset($this->date_sortie_accessoire) ? "'$this->date_sortie_accessoire'" : "''").",
	prix_accessoire=".(isset($this->prix_accessoire) ? "'$this->prix_accessoire'" : "0").",
	ref_accessoire=".(isset($this->ref_accessoire) ? "'$this->ref_accessoire'" : "0").",
	remarque_version_accessoire=".(isset($this->remarque_version_accessoire) ? "'$this->remarque_version_accessoire'" : "''")."
	".(isset($this->version_accessoire_valide) ? ", version_accessoire_valide='$this->version_accessoire_valide'" : "")."
				where id_version_accessoire=$this->id_version_accessoire;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  

  public function delete() {
     $query = "DELETE FROM bddjv_version_accessoire WHERE id_version_accessoire =".$this->id_version_accessoire;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->photo_accessoire=="")
	{
		$this->photo_accessoire='img/inconnu.png';
	}
	$query = "
	SELECT COUNT(*) nb
	FROM bddjv_accessoire
	NATURAL JOIN bddjv_version_accessoire
	WHERE id_accessoire=".$this->id_accessoire."
	AND id_region!=0";
	$db = Base::getConnection();
	foreach($db->query($query) as $row)
	{
		$n = $row['nb'];
	}
	$query = "
	SELECT COUNT(*) nb
	FROM bddjv_accessoire
	NATURAL JOIN bddjv_version_accessoire
	WHERE id_accessoire=".$this->id_accessoire;
	foreach($db->query($query) as $row)
	{
		$m = $row['nb'];
	}
  	if($n>0 || $m==0)
	{
		$query = "INSERT INTO bddjv_version_accessoire VALUES (null, '".$this->id_accessoire."', '".$this->id_region."', '".$this->photo_accessoire."', '".$this->date_sortie_accessoire."', '".$this->prix_accessoire."', '".$this->ref_accessoire."', '".$this->version_accessoire_valide."', '".$this->remarque_version_accessoire."');";
		$db = Base::getConnection();
		$db->query($query);
		$this->setAttr( 'id_version_accessoire' , $db->LastInsertId() );
		return  $db->LastInsertId();
	}
	else
	{
		$query = "SELECT id_version_accessoire
		FROM bddjv_accessoire
		NATURAL JOIN bddjv_version_accessoire
		WHERE id_accessoire=".$this->id_accessoire."
		AND id_region=0";
		$db = Base::getConnection();
		foreach($db->query($query) as $row)
		{
			$this->setAttr('id_version_accessoire', $row['id_version_accessoire']);
		}
		return 0;
	}
  }
  
	public static function validerVersionAccessoire($id) {
     $query = "UPDATE bddjv_version_accessoire SET version_accessoire_valide='1' WHERE id_version_accessoire=".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
	public static function supprimerVersionAccessoire($id)
	{
	$db = Base::getConnection();
	$query = 'SELECT photo_accessoire
	FROM bddjv_version_accessoire 
	WHERE id_version_accessoire ='.$id;
	foreach($db->query($query) as $row)
	{
		if($row['photo_accessoire']!="" && $row['photo_accessoire']!="img/inconnu.png")
		{
			unlink($row['photo_accessoire']);
		}
	}
	 $db = Base::getConnection();
     $query = "DELETE FROM bddjv_version_accessoire WHERE id_version_accessoire =".$id;
	 $db->exec($query);
	}

    public static function findById($id_version_accessoire) {
	  
	  $query = "select * from bddjv_version_accessoire where id_version_accessoire=".$id_version_accessoire;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      if ($dbres!=null) {
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_version_accessoire', $d->id_version_accessoire);
	  $b->setAttr('id_accessoire', $d->id_accessoire);
	  $b->setAttr('id_region', $d->id_region);
	  $b->setAttr('photo_accessoire', $d->photo_accessoire);
	  $b->setAttr('date_sortie_accessoire', $d->date_sortie_accessoire);
	  $b->setAttr('prix_accessoire', $d->prix_accessoire);
	  $b->setAttr('ref_accessoire', $d->ref_accessoire);
	  $b->setAttr('version_accessoire_valide', $d->version_accessoire_valide);
	  $b->setAttr('remarque_version_accessoire', $d->remarque_version_accessoire);
	  return $b;
	  }
	  else
	  {
		return null;
	  }
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_version_accessoire ORDER BY id_version_accessoire DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version_accessoire',$row['id_version_accessoire']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('photo_accessoire',$row['photo_accessoire']);
			$temp->setAttr('date_sortie_accessoire',$row['date_sortie_accessoire']);
			$temp->setAttr('prix_accessoire',$row['prix_accessoire']);
			$temp->setAttr('ref_accessoire',$row['ref_accessoire']);
			$temp->setAttr('version_accessoire_valide',$row['version_accessoire_valide']);
			$temp->setAttr('remarque_version_accessoire',$row['remarque_version_accessoire']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findAllVersions($id_accessoire) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_version_accessoire NATURAL JOIN bddjv_region where id_accessoire='".$id_accessoire."' ORDER BY id_region" ;
	
		$temp = array();
		foreach($db->query($query) as $row)
		{
	  		$temp['id_version_accessoire']=$row['id_version_accessoire'];
	  		$temp['id_accessoire']=$row['id_accessoire'];
	  		$temp['id_region']=$row['id_region'];
	  		$temp['nom_region']=$row['nom_region'];
	  		$temp['logo_region']=$row['logo_region'];
	  		$temp['photo_accessoire']=$row['photo_accessoire'];
	  		$temp['date_sortie_accessoire']=$row['date_sortie_accessoire'];
	  		$temp['prix_accessoire']=$row['prix_accessoire'];
	  		$temp['ref_accessoire']=$row['ref_accessoire'];
	  		$temp['version_accessoire_valide']=$row['version_accessoire_valide'];
	  		$temp['remarque_version_accessoire']=$row['remarque_version_accessoire'];
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findIdVersion($id, $region) {
	
    $n=0;
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM bddjv_version_accessoire
	NATURAL JOIN bddjv_region 
	WHERE id_accessoire='.$id.' 
	AND nom_region="'.$region.'"';
	
		foreach($db->query($query) as $row)
		{
	  		$n=$row['id_version_accessoire'];
		}
		return $n;

    }
	
	public static function findInvalide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select id_accessoire, id_version_accessoire from bddjv_version_accessoire where version_accessoire_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_accessoire',$row['id_accessoire']);
	  		$temp->setAttr('id_version_accessoire',$row['id_version_accessoire']);
			$tab[] = $temp;
		}
		return $tab;
	}

	public static function countVersions()
	{
	  $query = "select max(id_version_accessoire) countV from bddjv_version_accessoire";
      $pdo = Base::getConnection();
	  foreach($pdo->query($query) as $row)
	  {
		return $row[countV];
	  }
	}
	
	
}
?>