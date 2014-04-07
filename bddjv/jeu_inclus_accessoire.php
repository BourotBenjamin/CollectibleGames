<?php

class jeu_inclus_accessoire {


  private $id_version; 
  private $id_accessoire;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_version : ". $this->id_version . "
				   id_accessoire ". $this->id_accessoire;
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

  public function delete() {
     $query = "DELETE FROM bddjv_jeu_inclus_accessoire WHERE id_version =".$this->id_version." and id_accessoire =".$this->id_accessoire;
	 $db = Base::getConnection();
	 $db->exec($query);
  }  
  
  public static function deleteByVersion($id) {
     $query = "DELETE FROM bddjv_jeu_inclus_accessoire WHERE id_version =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_jeu_inclus_accessoire VALUES ( '".$this->id_version."', '".$this->id_accessoire."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		
    public static function findByJeu($id_version) 
	{
		$tab = array();
		$db = Base::getConnection();
		$query = "select * from bddjv_jeu_inclus_accessoire where id_version=".$id_version;
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$tab[] = $temp;
		}
		return $tab;
    }
	
    public static function findAll() 
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT * FROM bddjv_jeu_inclus_accessoire ORDER BY id_version DESC';
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$tab[] = $temp;
		}
		return $tab;
    }
	
	public static function findByAccessoire($id_accessoire) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_jeu_inclus_accessoire where id_accessoire='".$id_accessoire."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>