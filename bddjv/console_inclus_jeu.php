<?php

class console_inclus_jeu {


  private $id_console; 
  private $id_jeu;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_console : ". $this->id_console . "
				   id_jeu ". $this->id_jeu;
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
     $query = "DELETE FROM bddjv_console_inclus_jeu WHERE id_console =".$this->id_console." and id_jeu =".$this->id_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
  public static function deleteByIdConsole($id) {
     $query = "DELETE FROM bddjv_console_inclus_jeu WHERE id_console =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
  public static function deleteByIdJeu($id) {
     $query = "DELETE FROM bddjv_console_inclus_jeu WHERE id_jeu =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_console_inclus_jeu VALUES ( '".$this->id_console."', '".$this->id_jeu."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		

    public static function findByJeu($id_console) {
	  
	  $query = "select * from bddjv_console_inclus_jeu where id_console=".$id_console;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_console', $d->id_console);
	  $b->setAttr('id_jeu', $d->id_jeu);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_console_inclus_jeu ORDER BY id_console DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByAccessoire($id_jeu) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console_inclus_jeu where id_jeu='".$id_jeu."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>