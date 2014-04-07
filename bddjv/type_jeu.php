<?php

class Type_jeu {


  private $id_type_jeu; 
  private $nom_type_jeu;
  private $logo_type_jeu;
  private $type_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_type_jeu : ". $this->id_type_jeu . "
				   nom_type_jeu ". $this->nom_type_jeu. "
				   logo_type_jeu ". $this->logo_type_jeu. "
				   type_valide ". $this->type_valide;
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
    if (!isset($this->id_type_jeu)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_type_jeu)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_type_jeu set nom_type_jeu=".(isset($this->nom_type_jeu) ? "'$this->nom_type_jeu'" : "null").",
	".(isset($this->logo_type_jeu) ?'logo_type_jeu="'.$this->logo_type_jeu.'",':"")."
	type_valide=".(isset($this->type_valide) ? "'$this->type_valide'" : "0")."
				where id_type_jeu=$this->id_type_jeu";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_type_jeu set type_valide='1' where id_type_jeu=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }

    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_type_jeu');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_type_jeu=$new where id_type_jeu=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_type_jeu WHERE id_type_jeu=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_type_jeu WHERE id_type_jeu =".$this->id_type_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_type_jeu=="")
	{
		$this->logo_type_jeu='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_type_jeu VALUES (null, '".$this->nom_type_jeu."','".$this->logo_type_jeu."','".$this->type_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_type_jeu' , $db->LastInsertId() );
	return  $this->id_type_jeu;
  }
		

 public static function findById($id_type_jeu) {
	$query = "select * from bddjv_type_jeu where id_type_jeu=".$id_type_jeu;
    $pdo = Base::getConnection();
    $dbres = $pdo->query($query);
    $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	$b = new self();
	$b->setAttr('id_type_jeu', $d->id_type_jeu);
	$b->setAttr('nom_type_jeu', $d->nom_type_jeu);
	$b->setAttr('logo_type_jeu', $d->logo_type_jeu);
	$b->setAttr('type_valide', $d->type_valide);
	return $b;
 }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_type_jeu ORDER BY nom_type_jeu';
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
		$temp->setAttr('nom_type_jeu',$row['nom_type_jeu']);
		$temp->setAttr('logo_type_jeu',$row['logo_type_jeu']);
		$temp->setAttr('type_valide',$row['type_valide']);
		$tab[] = $temp;
	}
	return $tab;

    }
	
	public static function findByName($nom_type_jeu) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_type_jeu where nom_type_jeu='".$nom_type_jeu."';" ;
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
		$temp->setAttr('nom_type_jeu',$row['nom_type_jeu']);
		$temp->setAttr('logo_type_jeu',$row['logo_type_jeu']);
		$temp->setAttr('type_valide',$row['type_valide']);
		$tab[] = $temp;
	}
		return $tab;
	}
	
	public static function findNonValide() 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_type_jeu where type_valide=0" ;
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
		$temp->setAttr('nom_type_jeu',$row['nom_type_jeu']);
		$temp->setAttr('logo_type_jeu',$row['logo_type_jeu']);
		$temp->setAttr('type_valide',$row['type_valide']);
		$tab[] = $temp;
	}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_type_jeu` WHERE `id_type_jeu` NOT IN (SELECT id_type_jeu FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_type_jeu']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
				$temp->setAttr('nom_type_jeu',$row['nom_type_jeu']);
				$temp->setAttr('logo_type_jeu',$row['logo_type_jeu']);
				$temp->setAttr('type_valide',$row['type_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_type_jeu 
		WHERE id_type_jeu IN
		(
			SELECT id_type_jeu
			FROM bddjv_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_type_jeu';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_type_jeu',$row['id_type_jeu']);
				$temp->setAttr('nom_type_jeu',$row['nom_type_jeu']);
				$temp->setAttr('logo_type_jeu',$row['logo_type_jeu']);
				$temp->setAttr('type_valide',$row['type_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>