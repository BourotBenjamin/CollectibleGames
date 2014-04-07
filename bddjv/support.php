<?php

class support {


  private $id_support; 
  private $nom_support;
  private $logo_support;
  private $support_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_support : ". $this->id_support . "
				   nom_support ". $this->nom_support;
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
    if (!isset($this->id_support)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_support)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_support set nom_support=".(isset($this->nom_support) ? "'$this->nom_support'" : "null").",
	".(isset($this->logo_support) ?'logo_support="'.$this->logo_support.'",':"")."
	support_valide=".(isset($this->support_valide) ? "'$this->support_valide'" : "0")."
				where id_support=$this->id_support";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_support set support_valide='1' where id_support=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_support');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_version_jeu set id_support=$new where id_support=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_support WHERE id_support=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_support WHERE id_support =".$this->id_support;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_support=="")
	{
		$this->logo_support='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_support VALUES (null, '".$this->nom_support."','".$this->logo_support."','".$this->support_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_support' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_support) {
	  
	  $query = "select * from bddjv_support where id_support=".$id_support;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_support', $d->id_support);
	  $b->setAttr('nom_support', $d->nom_support);
	  $b->setAttr('logo_support', $d->logo_support);
	  $b->setAttr('support_valide', $d->support_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_support ORDER BY nom_support';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_support',$row['id_support']);
			$temp->setAttr('nom_support',$row['nom_support']);
			$temp->setAttr('logo_support',$row['logo_support']);
			$temp->setAttr('support_valide',$row['support_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_support) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_support where nom_support='".$nom_support."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_support',$row['id_support']);
			$temp->setAttr('nom_support',$row['nom_support']);
			$temp->setAttr('logo_support',$row['logo_support']);
			$temp->setAttr('support_valide',$row['support_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_support where support_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_support',$row['id_support']);
			$temp->setAttr('nom_support',$row['nom_support']);
			$temp->setAttr('logo_support',$row['logo_support']);
			$temp->setAttr('support_valide',$row['support_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_support` WHERE `id_support` NOT IN (SELECT id_support FROM bddjv_version_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_support']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_support',$row['id_support']);
				$temp->setAttr('nom_support',$row['nom_support']);
				$temp->setAttr('logo_support',$row['logo_support']);
				$temp->setAttr('support_valide',$row['support_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_support 
		WHERE id_support IN
		(
			SELECT id_support
			FROM bddjv_jeu
			NATURAL JOIN bddjv_version_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_support';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_support',$row['id_support']);
				$temp->setAttr('nom_support',$row['nom_support']);
				$temp->setAttr('logo_support',$row['logo_support']);
				$temp->setAttr('support_valide',$row['support_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>