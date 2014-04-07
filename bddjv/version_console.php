<?php

class version_console {


  private $id_version_console; 
  private $id_console;
  private $id_region;
  private $photo_console;
  private $date_sortie_console; 
  private $prix_console; 
  private $ref_console; 
  private $version_console_valide; 
  private $remarque_version_console; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_version_console : ". $this->id_version_console . "
					id_console : ". $this->id_console . "
					id_region : ". $this->id_region . "
					photo_console : ". $this->photo_console . "
				   date_sortie_console ". $this->date_sortie_console . "
				   version_console_valide ". $this->version_console_valide . "
				   remarque_version_console ". $this->remarque_version_console;
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
    if (!isset($this->id_version_console)) 
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
    if (!isset($this->id_version_console)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_version_console set id_console=".(isset($this->id_console) ? "'$this->id_console'" : "").",
	id_region=".(isset($this->id_region) ? "'$this->id_region'" : "''").",
	".(isset($this->photo_console) ?'photo_console="'.$this->photo_console.'",':"")."
	date_sortie_console=".(isset($this->date_sortie_console) ? "'$this->date_sortie_console'" : "''").",
	prix_console=".(isset($this->prix_console) ? "'$this->prix_console'" : "''").",
	ref_console=".(isset($this->ref_console) ? "'$this->ref_console'" : "0").",
	remarque_version_console=".(isset($this->remarque_version_console) ? "'$this->remarque_version_console'" : "''")."
	".(isset($this->version_console_valide) ? ", version_console_valide='$this->version_console_valide'" : "")."
				where id_version_console=$this->id_version_console;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
  public function delete() {
     $query = "DELETE FROM bddjv_version_console WHERE id_version_console =".$this->id_version_console;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
	public static function validerVersionConsole($id) {
     $query = "UPDATE bddjv_version_console SET version_console_valide='1' WHERE id_version_console=".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
	public static function supprimerVersionConsole($id)
	{
	$db = Base::getConnection();
	$query = 'SELECT photo_console
	 FROM bddjv_version_console
	 WHERE id_version_console ='.$id;
	foreach($db->query($query) as $row)
	{
		if($row['photo_console']!="" && $row['photo_console']!="img/inconnu.png")
		{
			unlink($row['photo_console']);
		}
	}
	 $db = Base::getConnection();
     $query = "DELETE FROM bddjv_version_console WHERE id_version_console =".$id;
	 $db->exec($query);
	}

		
								
  public function insert() {
	if($this->photo_console=="")
	{
		$this->photo_console='img/inconnu.png';
	}
	$query = "
	SELECT COUNT(*) nb
	FROM bddjv_console
	NATURAL JOIN bddjv_version_console
	WHERE id_console=".$this->id_console."
	AND id_region!=0";
	$db = Base::getConnection();
	foreach($db->query($query) as $row)
	{
		$n = $row['nb'];
	}
	$query = "
	SELECT COUNT(*) nb
	FROM bddjv_console
	NATURAL JOIN bddjv_version_console
	WHERE id_console=".$this->id_console;
	foreach($db->query($query) as $row)
	{
		$m = $row['nb'];
	}
  	if($n>0 || $m==0)
	{
		$query = "INSERT INTO bddjv_version_console VALUES (null, '".$this->id_console."', '".$this->id_region."', '".$this->photo_console."', '".$this->date_sortie_console."', '".$this->prix_console."', '".$this->ref_console."', 0, '".$this->remarque_version_console."');";
		$db = Base::getConnection();
		$db->query($query);
		$this->setAttr( 'id_version_console' , $db->LastInsertId() );
		return  $db->LastInsertId();
	}
	else
	{
		$query = "SELECT id_version_console
		FROM bddjv_console
		NATURAL JOIN bddjv_version_console
		WHERE id_console=".$this->id_console."
		AND id_region=0";
		$db = Base::getConnection();
		foreach($db->query($query) as $row)
		{
			$this->setAttr('id_version_console', $row['id_version_console']);
		}
		return 0;
	}
  }
		

    public static function findById($id_version_console) {
	  
	  $query = "select * from bddjv_version_console where id_version_console=".$id_version_console;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      if ($dbres!=null) {
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_version_console', $d->id_version_console);
	  $b->setAttr('id_console', $d->id_console);
	  $b->setAttr('id_region', $d->id_region);
	  $b->setAttr('photo_console', $d->photo_console);
	  $b->setAttr('date_sortie_console', $d->date_sortie_console);
	  $b->setAttr('prix_console', $d->prix_console);
	  $b->setAttr('ref_console', $d->ref_console);
	  $b->setAttr('version_console_valide', $d->version_console_valide);
	  $b->setAttr('remarque_version_console', $d->remarque_version_console);
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
	$query = 'SELECT * FROM bddjv_version_console ORDER BY id_version_console DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version_console',$row['id_version_console']);
			$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('photo_console',$row['photo_console']);
			$temp->setAttr('date_sortie_console',$row['date_sortie_console']);
			$temp->setAttr('prix_console',$row['prix_console']);
			$temp->setAttr('ref_console',$row['ref_console']);
			$temp->setAttr('version_console_valide',$row['version_console_valide']);
			$temp->setAttr('remarque_version_console',$row['remarque_version_console']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($id_console) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_version_console where id_console='".$id_console."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version_console',$row['id_version_console']);
			$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('photo_console',$row['photo_console']);
			$temp->setAttr('date_sortie_console',$row['date_sortie_console']);
			$temp->setAttr('prix_console',$row['prix_console']);
			$temp->setAttr('ref_console',$row['ref_console']);
			$temp->setAttr('version_console_valide',$row['version_console_valide']);
			$temp->setAttr('remarque_version_console',$row['remarque_version_console']);
			$tab[] = $temp;
		}
		return $tab;
	}	
	
	public static function findAllVersions($id_console) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_version_console NATURAL JOIN bddjv_region where id_console='".$id_console."' ORDER BY id_region" ;
	
		$temp = array();
		foreach($db->query($query) as $row)
		{
	  		$temp['id_version_console']=$row['id_version_console'];
	  		$temp['id_console']=$row['id_console'];
	  		$temp['id_region']=$row['id_region'];
	  		$temp['nom_region']=$row['nom_region'];
	  		$temp['logo_region']=$row['logo_region'];
	  		$temp['photo_console']=$row['photo_console'];
	  		$temp['date_sortie_console']=$row['date_sortie_console'];
	  		$temp['prix_console']=$row['prix_console'];
	  		$temp['ref_console']=$row['ref_console'];
	  		$temp['version_console_valide']=$row['version_console_valide'];
	  		$temp['remarque_version_console']=$row['remarque_version_console'];
			$tab[] = $temp;
		}
		return $tab;
	}
	
	
	public static function findIdVersion($id, $region) {
	
    $n=0;
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM bddjv_version_console
	NATURAL JOIN bddjv_region 
	WHERE id_console='.$id.' 
	AND nom_region="'.$region.'"';
	
		foreach($db->query($query) as $row)
		{
	  		$n=$row['id_version_console'];
		}
		return $n;

    }
	
	public static function findInvalide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select id_console, id_version_console from bddjv_version_console where version_console_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_console',$row['id_console']);
	  		$temp->setAttr('id_version_console',$row['id_version_console']);
			$tab[] = $temp;
		}
		return $tab;
	}

	public static function countVersions()
	{
	  $query = "select max(id_version_console) countV from bddjv_version_console";
      $pdo = Base::getConnection();
	  foreach($pdo->query($query) as $row)
	  {
		return $row[countV];
	  }
	}
}
?>