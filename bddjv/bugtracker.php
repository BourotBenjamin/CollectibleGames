<?php

class Bugtracker {


  private $id_bugtracker ; 
  private $description_bug;
  private $type_bug;
  private $priorite_bug;
  private $resolu_bug;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_bugtracker : ". $this->id_bugtracker . "
				   description_bug  ". $this->description_bug  ."
				   type_bug ". $this->type_bug."
				   priorite_bug ". $this->priorite_bug."
				   resolu_bug  ". $this->resolu_bug;
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
    if (!isset($this->id_bugtracker)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    
    if (!isset($this->id_bugtracker)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bugtracker set description_bug=".(isset($this->description_bug) ? "'$this->description_bug'" : "null").",
                                    type_bug=".(isset($this->type_bug) ? "'$this->type_bug'" : "null").",
									priorite_bug=".(isset($this->priorite_bug) ? "'$this->priorite_bug'" : "null").",
									resolu_bug=".(isset($this->resolu_bug) ? "'$this->resolu_bug'" : "null").",
				where id_bugtracker=$this->id_bugtracker";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bugtracker WHERE id_bugtracker =".$this->id_bugtracker;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  
  	$query = "INSERT INTO bugtracker VALUES (null, '".$this->description_bug."','".$this->type_bug."','".$this->priorite_bug."','".$this->resolu_bug."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_bugtracker' , $db->LastInsertId() );
	return $this->id_bugtracker;
  }
		

    public static function findById($id_bugtracker) {
	  
	  $query = "select * from bugtracker where id_bugtracker=".$id_bugtracker;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_bugtracker', $d->id_bugtracker);
	  $b->setAttr('description_bug', $d->description_bug);
	  $b->setAttr('type_bug', $d->type_bug);
	  $b->setAttr('priorite_bug', $d->priorite_bug);
	  $b->setAttr('resolu_bug', $d->resolu_bug);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bugtracker ORDER BY resolu_bug, priorite_bug DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_bugtracker',$row['id_bugtracker']);
			$temp->setAttr('description_bug',$row['description_bug']);
			$temp->setAttr('type_bug',$row['type_bug']);
			$temp->setAttr('priorite_bug',$row['priorite_bug']);
			$temp->setAttr('resolu_bug',$row['resolu_bug']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
}
?>