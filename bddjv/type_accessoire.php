<?php

class Type_accessoire {


  private $id_type_accessoire; 
  private $nom_type_accessoire;
  private $logo_type_accessoire;
  private $type_accessoire_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_type_accessoire : ". $this->id_type_accessoire . "
				   nom_type_accessoire ". $this->nom_type_accessoire. "
				   logo_type_accessoire ". $this->logo_type_accessoire. "
				   type_accessoire_valide ". $this->type_accessoire_valide;
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
    if (!isset($this->id_type_accessoire)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_type_accessoire)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_type_accessoire set nom_type_accessoire=".(isset($this->nom_type_accessoire) ? "'$this->nom_type_accessoire'" : "null").",
	".(isset($this->logo_type_accessoire) ?'logo_type_accessoire="'.$this->logo_type_accessoire.'",':"")."
	type_accessoire_valide=".(isset($this->type_accessoire_valide) ? "'$this->type_accessoire_valide'" : "0")."
				where id_type_accessoire=$this->id_type_accessoire";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_type_accessoire set type_accessoire_valide='1' where id_type_accessoire=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }

    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_type_accessoire');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_accessoire set id_type_accessoire=$new where id_type_accessoire=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_type_accessoire WHERE id_type_accessoire=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_type_accessoire WHERE id_type_accessoire =".$this->id_type_accessoire;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_type_accessoire=="")
	{
		$this->logo_type_accessoire='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_type_accessoire VALUES (null, '".$this->nom_type_accessoire."','".$this->logo_type_accessoire."','".$this->type_accessoire_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_type_accessoire' , $db->LastInsertId() );
	return  $this->id_type_accessoire;
  }
		

 public static function findById($id_type_accessoire) {
	$query = "select * from bddjv_type_accessoire where id_type_accessoire=".$id_type_accessoire;
    $pdo = Base::getConnection();
    $dbres = $pdo->query($query);
    $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	$b = new self();
	$b->setAttr('id_type_accessoire', $d->id_type_accessoire);
	$b->setAttr('nom_type_accessoire', $d->nom_type_accessoire);
	$b->setAttr('logo_type_accessoire', $d->logo_type_accessoire);
	$b->setAttr('type_accessoire_valide', $d->type_accessoire_valide);
	return $b;
 }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_type_accessoire ORDER BY nom_type_accessoire';
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
		$temp->setAttr('nom_type_accessoire',$row['nom_type_accessoire']);
		$temp->setAttr('logo_type_accessoire',$row['logo_type_accessoire']);
		$temp->setAttr('type_accessoire_valide',$row['type_accessoire_valide']);
		$tab[] = $temp;
	}
	return $tab;

    }
	
	public static function findByName($nom_type_accessoire) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_type_accessoire where nom_type_accessoire='".$nom_type_accessoire."';" ;
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
		$temp->setAttr('nom_type_accessoire',$row['nom_type_accessoire']);
		$temp->setAttr('logo_type_accessoire',$row['logo_type_accessoire']);
		$temp->setAttr('type_accessoire_valide',$row['type_accessoire_valide']);
		$tab[] = $temp;
	}
		return $tab;
	}
	
	public static function findNonValide() 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_type_accessoire where type_accessoire_valide=0" ;
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
		$temp->setAttr('nom_type_accessoire',$row['nom_type_accessoire']);
		$temp->setAttr('logo_type_accessoire',$row['logo_type_accessoire']);
		$temp->setAttr('type_accessoire_valide',$row['type_accessoire_valide']);
		$tab[] = $temp;
	}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_type_accessoire` WHERE `id_type_accessoire` NOT IN (SELECT id_type_accessoire FROM bddjv_accessoire);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_type_accessoire']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
				$temp->setAttr('nom_type_accessoire',$row['nom_type_accessoire']);
				$temp->setAttr('logo_type_accessoire',$row['logo_type_accessoire']);
				$temp->setAttr('type_accessoire_valide',$row['type_accessoire_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_type_accessoire 
		WHERE id_type_accessoire IN
		(
			SELECT id_type_accessoire
			FROM bddjv_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_type_accessoire';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
				$temp->setAttr('nom_type_accessoire',$row['nom_type_accessoire']);
				$temp->setAttr('logo_type_accessoire',$row['logo_type_accessoire']);
				$temp->setAttr('type_accessoire_valide',$row['type_accessoire_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>