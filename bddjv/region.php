<?php

class region {


  private $id_region; 
  private $nom_region;
  private $logo_region;
  private $region_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_region : ". $this->id_region . " 
		nom_region : ". $this->nom_region . "
				   logo_region ". $this->logo_region;
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
    if (!isset($this->id_region)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_region)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_region set nom_region=".(isset($this->nom_region) ? "'$this->nom_region'" : "null").",
	".(isset($this->logo_region) ?'logo_region="'.$this->logo_region.'",':"")."
	region_valide=".(isset($this->region_valide) ? "'$this->region_valide'" : "0")."
				where id_region=$this->id_region";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_region set region_valide='1' where id_region=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_region');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_version_jeu set id_region=$new where id_region=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_region WHERE id_region=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_region WHERE id_region =".$this->id_region;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_region=="")
	{
		$this->logo_region='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_region VALUES (null, '".$this->nom_region."','".$this->logo_region."','".$this->region_valide."', 0);";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_region' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_region) {
	  
	  $query = "select * from bddjv_region where id_region=".$id_region;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_region', $d->id_region);
	  $b->setAttr('nom_region', $d->nom_region);
	  $b->setAttr('logo_region', $d->logo_region);
	  $b->setAttr('region_valide', $d->region_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_region ORDER BY nom_region';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('nom_region',$row['nom_region']);
			$temp->setAttr('logo_region',$row['logo_region']);
			$temp->setAttr('region_valide',$row['region_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_region) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_region where nom_region='".$nom_region."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('nom_region',$row['nom_region']);
			$temp->setAttr('logo_region',$row['logo_region']);
			$temp->setAttr('region_valide',$row['region_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_region where region_valide=0" ;
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_region',$row['id_region']);
			$temp->setAttr('nom_region',$row['nom_region']);
			$temp->setAttr('logo_region',$row['logo_region']);
			$temp->setAttr('region_valide',$row['region_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_region` WHERE `id_region` NOT IN (SELECT id_region FROM bddjv_version_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_region']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_region',$row['id_region']);
				$temp->setAttr('nom_region',$row['nom_region']);
				$temp->setAttr('logo_region',$row['logo_region']);
				$temp->setAttr('region_valide',$row['region_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_region 
		WHERE id_region IN
		(
			SELECT id_region
			FROM bddjv_jeu
			NATURAL JOIN bddjv_version_jeu
			WHERE id_plateforme='.$id.'
		)
		OR id_region IN
		(
			SELECT id_region
			FROM bddjv_accessoire
			NATURAL JOIN bddjv_version_accessoire
			WHERE id_plateforme='.$id.'
		)
		OR id_region IN
		(
			SELECT id_region
			FROM bddjv_console
			NATURAL JOIN bddjv_version_console
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_region';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_region',$row['id_region']);
				$temp->setAttr('nom_region',$row['nom_region']);
				$temp->setAttr('logo_region',$row['logo_region']);
				$temp->setAttr('region_valide',$row['region_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>