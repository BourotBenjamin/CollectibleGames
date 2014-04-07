<?php

class rapport_jeu {


  private $id_rapport; 
  private $id_jeu;
  private $rapport_jeu;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_rapport : ". $this->id_rapport . "
				   id_jeu  ". $this->id_jeu  ."
				   rapport_jeu ". $this->rapport_jeu;
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
    
    if (!isset($this->id_rapport)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_rapport_jeu set rapport_jeu=".(isset($this->rapport_jeu) ? "'$this->rapport_jeu'" : "null")."
				where id_rapport=$this->id_rapport and id_jeu=$this->id_jeu";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_rapport_jeu WHERE id_rapport =".$this->id_rapport;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_rapport_jeu VALUES (null, '".$this->id_jeu."','".$this->rapport_jeu."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_rapport_jeu ORDER BY id_rapport DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_rapport',$row['id_rapport']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('rapport_jeu',$row['rapport_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findById($id) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_rapport_jeu where id_rapport='".$id."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_rapport',$row['id_rapport']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('rapport_jeu',$row['rapport_jeu']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>