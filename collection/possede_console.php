<?php

class Possede_console {


  private $id_possede_console; 
  private $user_id;
  private $id_console;
  private $id_version_console;
  private $etat_console;
  private $boite_console;
  private $notice_console;
  private $machine_console;
  private $cale_console;
  private $console_scelle;
  private $commentaire_console;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_possede_console : ". $this->id_possede_console . "
				   user_id  ". $this->user_id  ."
				   id_console  ". $this->id_console  ."
				   id_version_console ". $this->id_version_console."
				   etat_console ". $this->etat_console."
				   notice_console ". $this->notice_console."
				   machine_console ". $this->machine_console."
				   cale_console ". $this->cale_console."
				   boite_console ". $this->boite_console."
				   console_scelle ". $this->console_scelle."
				   commentaire_console  ". $this->commentaire_console;
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
	  if(isset($this->id_possede_console))
	  {
		  $return = $this->update();
	  }
	  else
	  {
		$return =  $this->insert();
		if($return==0) 
		{
		  $return = $this->update();
		}
	  }
      
	return $return;
  }


  public function update() {
    
    if (!isset($this->id_possede_console)) {
      return 0;
    } 
    
    $save_query = "update collection_possede_console set 
									".(isset($this->user_id) ? "user_id='$this->user_id'," : "")."
									".(isset($this->id_console) ? "id_console='$this->id_console'," : "")."
									".(isset($this->id_version_console) ? "id_version_console='$this->id_version_console'," : "")."
									".(isset($this->etat_console) ? "etat_console='$this->etat_console'," : "")."
									".(isset($this->notice_console) ? "notice_console='$this->notice_console'," : "")."
									".(isset($this->machine_console) ? "machine_console='$this->machine_console'," : "")."
									".(isset($this->cale_console) ? "cale_console='$this->cale_console'," : "")."
									".(isset($this->boite_console) ? "boite_console='$this->boite_console'," : "")."
									".(isset($this->console_scelle) ? "console_scelle='$this->console_scelle'," : "")."
									".(isset($this->commentaire_console) ? "commentaire_console='$this->commentaire_console'," : "")."
				id_possede_console=$this->id_possede_console where id_possede_console=$this->id_possede_console";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM collection_possede_console WHERE id_possede_console =".$this->id_possede_console;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
								
  public function insert() {
  
  	$query = "INSERT INTO collection_possede_console VALUES ('".$this->id_possede_console."','".$this->user_id."','".$this->id_console."','".$this->id_version_console."','".$this->etat_console."','".$this->boite_console."','".$this->notice_console."','".$this->machine_console."','".$this->cale_console."','".$this->console_scelle."','".$this->commentaire_console."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	if($db->lastInsertId()!=0)
	{
		$this->setAttr('id_possede_console', $db->lastInsertId());
	}
	return $nb;
  }
		

    public static function findById($id_possede_console) {
	  
	  $query = "select * from collection_possede_console where id_possede_console=".$id_possede_console;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_possede_console', $d->id_possede_console);
	  $b->setAttr('id_console', $d->id_console);
	  $b->setAttr('user_id', $d->user_id);
	  $b->setAttr('id_version_console', $d->id_version_console);
	  $b->setAttr('etat_console', $d->etat_console);
	  $b->setAttr('notice_console', $d->notice_console);
	  $b->setAttr('machine_console', $d->machine_console);
	  $b->setAttr('cale_console', $d->cale_console);
	  $b->setAttr('boite_console', $d->boite_console);
	  $b->setAttr('console_scelle', $d->console_scelle);
	  $b->setAttr('commentaire_console', $d->commentaire_console);
	  
	  return $b;
    }
		
    public static function findByInfos($id_possede_console ) {
	  
	  	$query = "SELECT * 
		FROM collection_possede_console 
		NATURAL JOIN bddjv_console
		NATURAL JOIN bddjv_version_console
		NATURAL JOIN bddjv_region
		where id_possede_console =".$id_possede_console;
		$pdo = Base::getConnection();
		$dbres = $pdo->query($query);
		foreach($pdo->query($query) as $row)
		{
				$temp = array();
				$temp['id_possede_console']=$row['id_possede_console'];
				$temp['user_id']=$row['user_id'];
				$temp['id_console']=$row['id_console'];
				$temp['id_version_console']=$row['id_version_console'];
				$temp['etat_console']=$row['etat_console'];
				$temp['commentaire_console']=$row['commentaire_console'];
				$temp['notice_console']=$row['notice_console'];
				$temp['machine_console']=$row['machine_console'];
				$temp['cale_console']=$row['cale_console'];
				$temp['boite_console']=$row['boite_console'];
				$temp['console_scelle']=$row['console_scelle'];
				$temp['nom_console']=$row['nom_console'];
				$temp['nom_region']=$row['nom_region'];
		}
	  return $temp;
    }
	
	
	public static function findAllByUser($user_id) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM collection_possede_console 
	NATURAL JOIN bddjv_console
	NATURAL JOIN bddjv_version_console
	WHERE user_id='.$user_id.'
	ORDER BY id_plateforme, console_scelle DESC, boite_console DESC, machine_console DESC, notice_console DESC, nom_console';
		foreach($db->query($query) as $row)
		{
			$temp = array();
	  		$temp['id_possede_console']=$row['id_possede_console'];
			$temp['user_id']=$row['user_id'];
			$temp['id_console']=$row['id_console'];
			$temp['photo_console']=$row['photo_console'];
			$temp['id_version_console']=$row['id_version_console'];
			$temp['etat_console']=$row['etat_console'];
			$temp['notice_console']=$row['notice_console'];
			$temp['machine_console']=$row['machine_console'];
			$temp['cale_console']=$row['cale_console'];
			$temp['boite_console']=$row['boite_console'];
			$temp['boite_console']=$row['boite_console'];
			$temp['console_scelle']=$row['console_scelle'];
			$temp['commentaire_console']=$row['commentaire_console'];
			$temp['nom_console']=$row['nom_console'];
			$tab[] = $temp;
		}
		return $tab;

    }
	public static function findAllIdByUser($user_id) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM collection_possede_console
	WHERE user_id='.$user_id;
		foreach($db->query($query) as $row)
		{
			$tab[] = $row['id_console'];
		}
		return $tab;
	}
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM collection_possede_console ORDER BY id_possede_console DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_possede_console',$row['id_possede_console']);
			$temp->setAttr('user_id',$row['user_id']);
			$temp->setAttr('id_console',$row['id_console']);
			$temp->setAttr('id_version_console',$row['id_version_console']);
			$temp->setAttr('etat_console',$row['etat_console']);
			$temp->setAttr('notice_console',$row['notice_console']);
			$temp->setAttr('machine_console',$row['machine_console']);
			$temp->setAttr('cale_console',$row['cale_console']);
			$temp->setAttr('boite_console',$row['boite_console']);
			$temp->setAttr('console_scelle',$row['console_scelle']);
			$temp->setAttr('commentaire_console',$row['commentaire_console']);
			$tab[] = $temp;
		}
		return $tab;

    }
	

	public static function countConsoles($id)
	{
	  $query = "select count(id_possede_console) countV FROM collection_possede_console WHERE user_id='".$id."'";
      $pdo = Base::getConnection();
	  foreach($pdo->query($query) as $row)
	  {
		return $row[countV];
	  }
	}
	
	
}
?>