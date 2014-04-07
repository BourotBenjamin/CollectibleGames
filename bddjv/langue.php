<?php

class Langue {


  private $id_langue; 
  private $nom_langue;
  private $logo_langue;
  private $langue_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_langue : ". $this->id_langue . "
				   nom_langue ". $this->nom_langue. "
				   logo_langue ". $this->logo_langue. "
				   langue_valide ". $this->langue_valide;
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
    if (!isset($this->id_langue)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_langue)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_langues set nom_langue=".(isset($this->nom_langue) ? "'$this->nom_langue'" : "null").",
	".(isset($this->logo_langue) ?'logo_langue="'.$this->logo_langue.'",':"")."
	langue_valide=".(isset($this->langue_valide) ? "'$this->langue_valide'" : "0")."
				where id_langue=$this->id_langue";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_langues set langue_valide='1' where id_langue=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_langue');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_langue_jeu set id_langue=$new where id_langue=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_langues WHERE id_langue=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_langues WHERE id_langue =".$this->id_langue;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_langue=="")
	{
		$this->logo_langue='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_langues VALUES (null, '".$this->nom_langue."','".$this->logo_langue."','".$this->langue_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_langue' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_langue) {
	  
	  $query = "select * from bddjv_langues where id_langue=".$id_langue;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      $b=null;
	  if($dbres!=null)
	  {
		  $d=$dbres->fetch(PDO::FETCH_OBJ) ;
		  $b = new self();
		  $b->setAttr('id_langue', $d->id_langue);
		  $b->setAttr('nom_langue', $d->nom_langue);
		  $b->setAttr('logo_langue', $d->logo_langue);
		  $b->setAttr('langue_valide', $d->langue_valide);
	  }
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_langues ORDER BY nom_langue';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_langue',$row['id_langue']);
			$temp->setAttr('nom_langue',$row['nom_langue']);
			$temp->setAttr('logo_langue',$row['logo_langue']);
			$temp->setAttr('langue_valide',$row['langue_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_langue) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_langues where nom_langue='".$nom_langue."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_langue',$row['id_langue']);
			$temp->setAttr('nom_langue',$row['nom_langue']);
			$temp->setAttr('logo_langue',$row['logo_langue']);
			$temp->setAttr('langue_valide',$row['langue_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_langues where langue_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_langue',$row['id_langue']);
			$temp->setAttr('nom_langue',$row['nom_langue']);
			$temp->setAttr('logo_langue',$row['logo_langue']);
			$temp->setAttr('langue_valide',$row['langue_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_langues` WHERE `id_langue` NOT IN (SELECT id_langue FROM bddjv_langue_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_langue']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_langue',$row['id_langue']);
				$temp->setAttr('nom_langue',$row['nom_langue']);
				$temp->setAttr('logo_langue',$row['logo_langue']);
				$temp->setAttr('langue_valide',$row['langue_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_langues
		WHERE id_langue IN
		(
			SELECT id_langue
			FROM bddjv_jeu
			NATURAL JOIN bddjv_langue_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_langue';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_langue',$row['id_langue']);
				$temp->setAttr('nom_langue',$row['nom_langue']);
				$temp->setAttr('logo_langue',$row['logo_langue']);
				$temp->setAttr('langue_valide',$row['langue_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>