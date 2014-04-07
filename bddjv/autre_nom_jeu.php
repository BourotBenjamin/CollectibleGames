<?php

class autre_nom_jeu {


  private $id_jeu; 
  private $id_version;
  private $id_nom_jeu;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_jeu : ". $this->id_jeu . "
				   id_version  ". $this->id_version  ."
				   id_nom_jeu ". $this->id_nom_jeu;
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
      return $this->insert();
  }


  public function update() {
    
    if (!isset($this->id_jeu)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_autre_nom_jeu set id_nom_jeu=".(isset($this->id_nom_jeu) ? "'$this->id_nom_jeu'" : "null")."
				where id_jeu=$this->id_jeu and id_version=$this->id_version";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_autre_nom_jeu WHERE id_jeu =".$this->id_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_autre_nom_jeu VALUES (".$this->id_jeu.", '".$this->id_version."','".$this->id_nom_jeu."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		

    public static function findByConsole($id_jeu) {
	  
	  $query = "select * from bddjv_autre_nom_jeu where id_jeu=".$id_jeu;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_jeu', $d->id_jeu);
	  $b->setAttr('id_version', $d->id_version);
	  $b->setAttr('id_nom_jeu', $d->id_nom_jeu);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_autre_nom_jeu ORDER BY id_jeu DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByAccessoire($id_version) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_autre_nom_jeu where id_version='".$id_version."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_nom_jeu',$row['id_nom_jeu']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>