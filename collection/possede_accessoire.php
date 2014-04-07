<?php

class Possede_accessoire {


  private $id_possede_accessoire; 
  private $user_id;
  private $id_accessoire;
  private $id_version_accessoire;
  private $etat_accessoire;
  private $boite_accessoire;
  private $notice_accessoire;
  private $materiel_accessoire;
  private $blister_souple_accessoire;
  private $blister_rigide_accessoire;
  private $commentaire_accessoire;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_possede_accessoire : ". $this->id_possede_accessoire . "
				   user_id  ". $this->user_id  ."
				   id_accessoire  ". $this->id_accessoire  ."
				   id_version_accessoire ". $this->id_version_accessoire."
				   etat_accessoire ". $this->etat_accessoire."
				   notice_accessoire ". $this->notice_accessoire."
				   materiel_accessoire ". $this->materiel_accessoire."
				   blister_souple_accessoire ". $this->blister_souple_accessoire."
				   boite_accessoire ". $this->boite_accessoire."
				   blister_rigide_accessoire ". $this->blister_rigide_accessoire."
				   commentaire_accessoire  ". $this->commentaire_accessoire;
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
	  if(isset($this->id_possede_accessoire))
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
    
    if (!isset($this->id_possede_accessoire)) {
      return 0;
    } 
    
    $save_query = "update collection_possede_accessoire set 
									".(isset($this->user_id) ? "user_id='$this->user_id'," : "")."
									".(isset($this->id_accessoire) ? "id_accessoire='$this->id_accessoire'," : "")."
									".(isset($this->id_version_accessoire) ? "id_version_accessoire='$this->id_version_accessoire'," : "")."
									".(isset($this->etat_accessoire) ? "etat_accessoire='$this->etat_accessoire'," : "")."
									".(isset($this->notice_accessoire) ? "notice_accessoire='$this->notice_accessoire'," : "")."
									".(isset($this->materiel_accessoire) ? "materiel_accessoire='$this->materiel_accessoire'," : "")."
									".(isset($this->blister_souple_accessoire) ? "blister_souple_accessoire='$this->blister_souple_accessoire'," : "")."
									".(isset($this->boite_accessoire) ? "boite_accessoire='$this->boite_accessoire'," : "")."
									".(isset($this->blister_rigide_accessoire) ? "blister_rigide_accessoire='$this->blister_rigide_accessoire'," : "")."
									".(isset($this->commentaire_accessoire) ? "commentaire_accessoire='$this->commentaire_accessoire'," : "")."
				id_possede_accessoire=$this->id_possede_accessoire where id_possede_accessoire=$this->id_possede_accessoire";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM collection_possede_accessoire WHERE id_possede_accessoire =".$this->id_possede_accessoire;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
								
  public function insert() {
  
  	$query = "INSERT INTO collection_possede_accessoire VALUES ('".$this->id_possede_accessoire."','".$this->user_id."','".$this->id_accessoire."','".$this->id_version_accessoire."','".$this->etat_accessoire."','".$this->boite_accessoire."','".$this->notice_accessoire."','".$this->materiel_accessoire."','".$this->blister_souple_accessoire."','".$this->blister_rigide_accessoire."','".$this->commentaire_accessoire."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	if($db->lastInsertId()!=0)
	{
		$this->setAttr('id_possede_accessoire', $db->lastInsertId());
	}
	return $nb;
  }
		

    public static function findById($id_possede_accessoire) {
	  
	  $query = "select * from collection_possede_accessoire where id_possede_accessoire=".$id_possede_accessoire;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_possede_accessoire', $d->id_possede_accessoire);
	  $b->setAttr('id_accessoire', $d->id_accessoire);
	  $b->setAttr('user_id', $d->user_id);
	  $b->setAttr('id_version_accessoire', $d->id_version_accessoire);
	  $b->setAttr('etat_accessoire', $d->etat_accessoire);
	  $b->setAttr('notice_accessoire', $d->notice_accessoire);
	  $b->setAttr('materiel_accessoire', $d->materiel_accessoire);
	  $b->setAttr('blister_souple_accessoire', $d->blister_souple_accessoire);
	  $b->setAttr('boite_accessoire', $d->boite_accessoire);
	  $b->setAttr('blister_rigide_accessoire', $d->blister_rigide_accessoire);
	  $b->setAttr('commentaire_accessoire', $d->commentaire_accessoire);
	  
	  return $b;
    }
		
    public static function findByInfos($id_possede_accessoire) 
	{  
	  	$query = "SELECT * 
		FROM collection_possede_accessoire 
		NATURAL JOIN bddjv_accessoire
		NATURAL JOIN bddjv_version_accessoire
		NATURAL JOIN bddjv_region
		where id_possede_accessoire=".$id_possede_accessoire;
		$pdo = Base::getConnection();
		$dbres = $pdo->query($query);
		foreach($pdo->query($query) as $row)
		{
				$temp = array();
				$temp['id_possede_accessoire']=$row['id_possede_accessoire'];
				$temp['user_id']=$row['user_id'];
				$temp['id_accessoire']=$row['id_accessoire'];
				$temp['id_version_accessoire']=$row['id_version_accessoire'];
				$temp['etat_accessoire']=$row['etat_accessoire'];
				$temp['notice_accessoire']=$row['notice_accessoire'];
				$temp['materiel_accessoire']=$row['materiel_accessoire'];
				$temp['boite_accessoire']=$row['boite_accessoire'];
				$temp['blister_souple_accessoire']=$row['blister_souple_accessoire'];
				$temp['blister_rigide_accessoire']=$row['blister_rigide_accessoire'];
				$temp['commentaire_accessoire']=$row['commentaire_accessoire'];
				$temp['nom_accessoire']=$row['nom_accessoire'];
				$temp['nom_region']=$row['nom_region'];
		}
	  return $temp;
    }
	
	public static function findAllByUser($user_id) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM collection_possede_accessoire 
	NATURAL JOIN bddjv_accessoire
	NATURAL JOIN bddjv_version_accessoire
	WHERE user_id='.$user_id.'
	ORDER BY id_plateforme, blister_rigide_accessoire DESC, boite_accessoire DESC, materiel_accessoire DESC, notice_accessoire DESC, nom_accessoire';
		foreach($db->query($query) as $row)
		{
			$temp = array();
	  		$temp['id_possede_accessoire']=$row['id_possede_accessoire'];
			$temp['user_id']=$row['user_id'];
			$temp['id_accessoire']=$row['id_accessoire'];
			$temp['photo_accessoire']=$row['photo_accessoire'];
			$temp['id_version_accessoire']=$row['id_version_accessoire'];
			$temp['etat_accessoire']=$row['etat_accessoire'];
			$temp['notice_accessoire']=$row['notice_accessoire'];
			$temp['materiel_accessoire']=$row['materiel_accessoire'];
			$temp['blister_souple_accessoire']=$row['blister_souple_accessoire'];
			$temp['boite_accessoire']=$row['boite_accessoire'];
			$temp['boite_accessoire']=$row['boite_accessoire'];
			$temp['blister_rigide_accessoire']=$row['blister_rigide_accessoire'];
			$temp['commentaire_accessoire']=$row['commentaire_accessoire'];
			$temp['nom_accessoire']=$row['nom_accessoire'];
			$tab[] = $temp;
		}
		return $tab;

    }
	public static function findAllIdByUser($user_id) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM collection_possede_accessoire 
	WHERE user_id='.$user_id;
		foreach($db->query($query) as $row)
		{
			$tab[] = $row['id_accessoire'];
		}
		return $tab;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM collection_possede_accessoire ORDER BY id_possede_accessoire DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_possede_accessoire',$row['id_possede_accessoire']);
			$temp->setAttr('user_id',$row['user_id']);
			$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$temp->setAttr('id_version_accessoire',$row['id_version_accessoire']);
			$temp->setAttr('etat_accessoire',$row['etat_accessoire']);
			$temp->setAttr('notice_accessoire',$row['notice_accessoire']);
			$temp->setAttr('materiel_accessoire',$row['materiel_accessoire']);
			$temp->setAttr('blister_souple_accessoire',$row['blister_souple_accessoire']);
			$temp->setAttr('boite_accessoire',$row['boite_accessoire']);
			$temp->setAttr('blister_rigide_accessoire',$row['blister_rigide_accessoire']);
			$temp->setAttr('commentaire_accessoire',$row['commentaire_accessoire']);
			$tab[] = $temp;
		}
		return $tab;

    }
	

	public static function countaccessoires($id)
	{
	  $query = "select count(id_possede_accessoire) countV FROM collection_possede_accessoire WHERE user_id='".$id."'";
      $pdo = Base::getConnection();
	  foreach($pdo->query($query) as $row)
	  {
		return $row[countV];
	  }
	}
	
	
}
?>