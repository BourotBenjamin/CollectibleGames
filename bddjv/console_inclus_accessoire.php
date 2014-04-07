<?php

class console_inclus_accessoire {


  private $id_console; 
  private $id_accessoire;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_console : ". $this->id_console . "
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
     $query = "DELETE FROM bddjv_console_inclus_accessoire WHERE id_console =".$this->id_console." and id_accessoire =".$this->id_accessoire;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
  public static function deleteByIdConsole($id) {
     $query = "DELETE FROM bddjv_console_inclus_accessoire WHERE id_console =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
  public static function deleteByIdAccessoire($id) {
     $query = "DELETE FROM bddjv_console_inclus_accessoire WHERE id_accessoire =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_console_inclus_accessoire VALUES ( '".$this->id_console."', '".$this->id_accessoire."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		

    public static function findByJeu($id_console) {
	  
	  $query = "select * from bddjv_console_inclus_accessoire where id_console=".$id_console;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_console', $d->id_console);
	  $b->setAttr('id_accessoire', $d->id_accessoire);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_console_inclus_accessoire ORDER BY id_console DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByAccessoire($id_accessoire) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console_inclus_accessoire where id_accessoire='".$id_accessoire."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>