<?php

class nom_jeu {


  private $id_nom_jeu; 
  private $nom_jeu;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_nom_jeu : ". $this->id_nom_jeu . "
				   nom_jeu ". $this->nom_jeu;
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
    if (!isset($this->id_nom_jeu)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    
    if (!isset($this->id_nom_jeu)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_nom_jeu set nom_jeu=".(isset($this->nom_jeu) ? "'$this->nom_jeu'" : "null")."
				where id_nom_jeu=$this->id_nom_jeu";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_nom_jeu WHERE id_nom_jeu =".$this->id_nom_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_nom_jeu VALUES (null, '".$this->nom_jeu."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_nom_jeu' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_nom_jeu) {
	  
	  $query = "select * from bddjv_nom_jeu where id_nom_jeu=".$id_nom_jeu;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_nom_jeu', $d->id_nom_jeu);
	  $b->setAttr('nom_jeu', $d->nom_jeu);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_nom_jeu ORDER BY id_nom_jeu DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$temp->setAttr('nom_jeu',$row['nom_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_jeu) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_nom_jeu where nom_jeu='".$nom_jeu."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$temp->setAttr('nom_jeu',$row['nom_jeu']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_nom_jeu` WHERE `id_nom_jeu` NOT IN (SELECT id_nom_jeu FROM bddjv_autre_nom_jeu) OR `id_nom_jeu` NOT IN (SELECT id_nom_jeu FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_nom_jeu']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
				$temp->setAttr('nom_jeu',$row['nom_jeu']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
}
?>