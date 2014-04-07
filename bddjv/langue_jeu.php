<?php

class Langue_jeu {


  private $id_jeu; 
  private $id_version;
  private $id_langue;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_jeu : ". $this->id_jeu . "
				   id_version  ". $this->id_version  ."
				   id_langue ". $this->id_langue;
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
    
    $save_query = "update bddjv_langue_jeu set id_langue=".(isset($this->id_langue) ? "'$this->id_langue'" : "null")."
				where id_jeu=$this->id_jeu and id_version=$this->id_version";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_langue_jeu WHERE id_jeu =".$this->id_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
  
  public static function deleteByVersion($id) {
     $query = "DELETE FROM bddjv_langue_jeu WHERE id_version =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_langue_jeu VALUES ('".$this->id_langue."', '".$this->id_jeu."', '".$this->id_version."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_langue_jeu ORDER BY id_jeu DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_langue',$row['id_langue']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByVersion($id_version) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_langue_jeu where id_version='".$id_version."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_langue',$row['id_langue']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>