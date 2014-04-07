<?php

class edition {


  private $id_edition; 
  private $nom_edition;
  private $logo_edition;
  private $edition_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_edition : ". $this->id_edition . "
				   nom_edition ". $this->nom_edition. "
				   logo_edition ". $this->logo_edition;
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
    if (!isset($this->id_edition)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_edition)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_edition set nom_edition=".(isset($this->nom_edition) ? "'$this->nom_edition'" : "null").",
	".(isset($this->logo_edition) ?'logo_edition="'.$this->logo_edition.'",':"")."
	edition_valide=".(isset($this->edition_valide) ? "'$this->edition_valide'" : "0")."
				where id_edition=$this->id_edition";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_edition set edition_valide='1' where id_edition=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_edition');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_version_jeu set id_edition=$new where id_edition=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_edition WHERE id_edition=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }




  public function delete() {
     $query = "DELETE FROM bddjv_edition WHERE id_edition =".$this->id_edition;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_edition=="")
	{
		$this->logo_edition='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_edition VALUES (null, '".$this->nom_edition."','".$this->logo_edition."','".$this->edition_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_edition' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_edition) {
	  
	  $query = "select * from bddjv_edition where id_edition=".$id_edition;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_edition', $d->id_edition);
	  $b->setAttr('nom_edition', $d->nom_edition);
	  $b->setAttr('logo_edition', $d->logo_edition);
	  $b->setAttr('edition_valide', $d->edition_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_edition ORDER BY nom_edition';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_edition',$row['id_edition']);
			$temp->setAttr('nom_edition',$row['nom_edition']);
			$temp->setAttr('logo_edition',$row['logo_edition']);
			$temp->setAttr('edition_valide',$row['edition_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_edition) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_edition where nom_edition='".$nom_edition."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_edition',$row['id_edition']);
			$temp->setAttr('nom_edition',$row['nom_edition']);
			$temp->setAttr('logo_edition',$row['logo_edition']);
			$temp->setAttr('edition_valide',$row['edition_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_edition where edition_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_edition',$row['id_edition']);
			$temp->setAttr('nom_edition',$row['nom_edition']);
			$temp->setAttr('logo_edition',$row['logo_edition']);
			$temp->setAttr('edition_valide',$row['edition_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_edition` WHERE `id_edition` NOT IN (SELECT id_edition FROM bddjv_version_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_edition']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_edition',$row['id_edition']);
				$temp->setAttr('nom_edition',$row['nom_edition']);
				$temp->setAttr('logo_edition',$row['logo_edition']);
				$temp->setAttr('edition_valide',$row['edition_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_edition 
		WHERE id_edition  IN
		(
			SELECT id_edition
			FROM bddjv_jeu
			NATURAL JOIN bddjv_version_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_edition';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_edition',$row['id_edition']);
				$temp->setAttr('nom_edition',$row['nom_edition']);
				$temp->setAttr('logo_edition',$row['logo_edition']);
				$temp->setAttr('edition_valide',$row['edition_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>