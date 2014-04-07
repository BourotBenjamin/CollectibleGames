<?php

class commande_jeu {


  private $id_jeu; 
  private $id_commande;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_jeu : ". $this->id_jeu . "
				   id_commande ". $this->id_commande;
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
     $query = "DELETE FROM bddjv_commande_jeu WHERE id_jeu =".$this->id_jeu." and id_commande =".$this->id_commande;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
  public static function deleteByIdJeu($id) {
     $query = "DELETE FROM bddjv_commande_jeu WHERE id_jeu =".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_commande_jeu VALUES ( '".$this->id_jeu."', '".$this->id_commande."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	return  $nb;
  }
		

    public static function findByJeu($id_jeu) {
	  
	  $query = "select * from bddjv_commande_jeu where id_jeu=".$id_jeu;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_jeu', $d->id_jeu);
	  $b->setAttr('id_commande', $d->id_commande);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_commande_jeu ORDER BY id_jeu DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_commande',$row['id_commande']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByAccessoire($id_commande) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_commande_jeu where id_commande='".$id_commande."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_commande',$row['id_commande']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>