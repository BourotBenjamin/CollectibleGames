<?php

class Description_Marque {


  private $id_editeur; 
  private $description_marque;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_editeur : ". $this->id_editeur . "
				   description_marque ". $this->description_marque;
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
    $nb = $this->insert();
    if($nb==0)
	{
      $nb = $this->update();
    }
	return $nb;
  }


  public function update() {
    
    if (!isset($this->id_editeur)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_description_marque set description_marque=".(isset($this->description_marque) ? "'$this->description_marque'" : "null")."
				where id_editeur=$this->id_editeur";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_description_marque WHERE id_editeur =".$this->id_editeur;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  
  	$query = "INSERT INTO bddjv_description_marque VALUES ('".$this->id_editeur."', '".$this->description_marque."');";
	$db = Base::getConnection();
	$db->query($query);
	return  $db->LastInsertId();
  }
		

    public static function findById($id_editeur) {
	  
	  $query = "select * from bddjv_description_marque where id_editeur=".$id_editeur;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      if ($dbres!=null) {
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_editeur', $d->id_editeur);
	  $b->setAttr('description_marque', $d->description_marque);
	  return $b;
	  }
	  else
	  {
		return null;
	  }
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_description_marque ORDER BY id_editeur DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('description_marque',$row['description_marque']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($description_marque) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_description_marque where description_marque='".$description_marque."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('description_marque',$row['description_marque']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>