<?php

class Possede_Jeu {


  private $id_possede_jeu; 
  private $user_id;
  private $id_jeu;
  private $id_version;
  private $etat_jeu;
  private $boite_jeu;
  private $notice_jeu;
  private $cartouche_jeu;
  private $cale_jeu;
  private $blister_souple_jeu;
  private $blister_rigide_jeu;
  private $commentaire_jeu;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_possede_jeu : ". $this->id_possede_jeu . "
				   user_id  ". $this->user_id  ."
				   id_jeu  ". $this->id_jeu  ."
				   id_version ". $this->id_version."
				   etat_jeu ". $this->etat_jeu."
				   notice_jeu ". $this->notice_jeu."
				   cartouche_jeu ". $this->cartouche_jeu."
				   cale_jeu ". $this->cale_jeu."
				   boite_jeu ". $this->boite_jeu."
				   blister_souple_jeu ". $this->blister_souple_jeu."
				   blister_rigide_jeu ". $this->blister_rigide_jeu."
				   commentaire_jeu  ". $this->commentaire_jeu;
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
	  if(isset($this->id_possede_jeu))
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
    
    if (!isset($this->id_possede_jeu)) {
      return 0;
    } 
    
    $save_query = "update collection_possede_jeu set 
									".(isset($this->user_id) ? "user_id='$this->user_id'," : "")."
									".(isset($this->id_jeu) ? "id_jeu='$this->id_jeu'," : "")."
									".(isset($this->id_version) ? "id_version='$this->id_version'," : "")."
									".(isset($this->etat_jeu) ? "etat_jeu='$this->etat_jeu'," : "")."
									".(isset($this->notice_jeu) ? "notice_jeu='$this->notice_jeu'," : "")."
									".(isset($this->cartouche_jeu) ? "cartouche_jeu='$this->cartouche_jeu'," : "")."
									".(isset($this->cale_jeu) ? "cale_jeu='$this->cale_jeu'," : "")."
									".(isset($this->boite_jeu) ? "boite_jeu='$this->boite_jeu'," : "")."
									".(isset($this->blister_souple_jeu) ? "blister_souple_jeu='$this->blister_souple_jeu'," : "")."
									".(isset($this->blister_rigide_jeu) ? "blister_rigide_jeu='$this->blister_rigide_jeu'," : "")."
									".(isset($this->commentaire_jeu) ? "commentaire_jeu='$this->commentaire_jeu'," : "")."
				id_possede_jeu=$this->id_possede_jeu where id_possede_jeu=$this->id_possede_jeu;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM collection_possede_jeu WHERE id_possede_jeu =".$this->id_possede_jeu;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
								
  public function insert() {
  
  	$query = "INSERT INTO collection_possede_jeu VALUES (null,'".$this->user_id."','".$this->id_jeu."','".$this->id_version."','".$this->etat_jeu."','".$this->boite_jeu."','".$this->notice_jeu."','".$this->cartouche_jeu."','".$this->cale_jeu."','".$this->blister_souple_jeu."','".$this->blister_rigide_jeu."','".$this->commentaire_jeu."');";
	$db = Base::getConnection();
	$nb = $db->exec($query);
	if($db->lastInsertId()!=0)
	{
		$this->setAttr('id_possede_jeu', $db->lastInsertId());
	}
	return $nb;
  }
		

    public static function findById($id_possede_jeu) {
	  
	  $query = "select * from collection_possede_jeu where id_possede_jeu=".$id_possede_jeu;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_possede_jeu', $d->id_possede_jeu);
	  $b->setAttr('id_jeu', $d->id_jeu);
	  $b->setAttr('user_id', $d->user_id);
	  $b->setAttr('id_version', $d->id_version);
	  $b->setAttr('etat_jeu', $d->etat_jeu);
	  $b->setAttr('notice_jeu', $d->notice_jeu);
	  $b->setAttr('cartouche_jeu', $d->cartouche_jeu);
	  $b->setAttr('cale_jeu', $d->cale_jeu);
	  $b->setAttr('boite_jeu', $d->boite_jeu);
	  $b->setAttr('blister_souple_jeu', $d->blister_souple_jeu);
	  $b->setAttr('blister_rigide_jeu', $d->blister_rigide_jeu);
	  $b->setAttr('commentaire_jeu', $d->commentaire_jeu);
	  
	  return $b;
    }
	
    public static function findByInfos($id_possede_jeu) {
	  
	  	$query = "SELECT * 
		FROM collection_possede_jeu 
		NATURAL JOIN bddjv_jeu
		NATURAL JOIN bddjv_version_jeu
		NATURAL JOIN bddjv_region
		NATURAL JOIN bddjv_edition
		where id_possede_jeu=".$id_possede_jeu;
		$pdo = Base::getConnection();
		$dbres = $pdo->query($query);
		foreach($pdo->query($query) as $row)
		{
				$temp = array();
				$temp['id_possede_jeu']=$row['id_possede_jeu'];
				$temp['user_id']=$row['user_id'];
				$temp['id_jeu']=$row['id_jeu'];
				$temp['id_version']=$row['id_version'];
				$temp['etat_jeu']=$row['etat_jeu'];
				$temp['notice_jeu']=$row['notice_jeu'];
				$temp['cartouche_jeu']=$row['cartouche_jeu'];
				$temp['cale_jeu']=$row['cale_jeu'];
				$temp['boite_jeu']=$row['boite_jeu'];
				$temp['blister_souple_jeu']=$row['blister_souple_jeu'];
				$temp['blister_rigide_jeu']=$row['blister_rigide_jeu'];
				$temp['commentaire_jeu']=$row['commentaire_jeu'];
				$temp['nom_jeu']=$row['nom_jeu'];
				$temp['nom_region']=$row['nom_region'];
				$temp['nom_edition']=$row['nom_edition'];
		}
	  return $temp;
    }
	
	public static function findAllByUser($user_id) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM collection_possede_jeu 
	NATURAL JOIN bddjv_jeu
	NATURAL JOIN bddjv_version_jeu
	NATURAL JOIN bddjv_nom_jeu
	WHERE user_id='.$user_id.'
	ORDER BY id_plateforme, blister_rigide_jeu DESC, blister_souple_jeu DESC, boite_jeu DESC, cartouche_jeu DESC, notice_jeu DESC, nom_jeu';
	foreach($db->query($query) as $row)
		{
			$temp = array();
	  		$temp['id_possede_jeu']=$row['id_possede_jeu'];
			$temp['user_id']=$row['user_id'];
			$temp['id_jeu']=$row['id_jeu'];
			$temp['photo_loose']=$row['photo_loose'];
			$temp['photo_boite']=$row['photo_boite'];
			$temp['photo_notice']=$row['photo_notice'];
			$temp['id_version']=$row['id_version'];
			$temp['etat_jeu']=$row['etat_jeu'];
			$temp['notice_jeu']=$row['notice_jeu'];
			$temp['cartouche_jeu']=$row['cartouche_jeu'];
			$temp['cale_jeu']=$row['cale_jeu'];
			$temp['boite_jeu']=$row['boite_jeu'];
			$temp['blister_souple_jeu']=$row['blister_souple_jeu'];
			$temp['blister_rigide_jeu']=$row['blister_rigide_jeu'];
			$temp['commentaire_jeu']=$row['commentaire_jeu'];
			$temp['nom_jeu']=$row['nom_jeu'];
			$tab[] = $temp;
		}
		return $tab;

    }
	public static function findAllIdByUser($user_id) {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * 
	FROM collection_possede_jeu 
	WHERE user_id='.$user_id;
		foreach($db->query($query) as $row)
		{
			$tab[] = $row['id_jeu'];
		}
		return $tab;

    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM collection_possede_jeu ORDER BY id_possede_jeu DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_possede_jeu',$row['id_possede_jeu']);
			$temp->setAttr('user_id',$row['user_id']);
			$temp->setAttr('id_jeu',$row['id_jeu']);
			$temp->setAttr('id_version',$row['id_version']);
			$temp->setAttr('etat_jeu',$row['etat_jeu']);
			$temp->setAttr('notice_jeu',$row['notice_jeu']);
			$temp->setAttr('cartouche_jeu',$row['cartouche_jeu']);
			$temp->setAttr('cale_jeu',$row['cale_jeu']);
			$temp->setAttr('boite_jeu',$row['boite_jeu']);
			$temp->setAttr('blister_souple_jeu',$row['blister_souple_jeu']);
			$temp->setAttr('blister_rigide_jeu',$row['blister_rigide_jeu']);
			$temp->setAttr('commentaire_jeu',$row['commentaire_jeu']);
			$tab[] = $temp;
		}
		return $tab;

    }
	

	public static function countJeux($id)
	{
	  $query = "select count(id_possede_jeu) countV FROM collection_possede_jeu WHERE user_id='".$id."'";
      $pdo = Base::getConnection();
	  foreach($pdo->query($query) as $row)
	  {
		return $row[countV];
	  }
	}
	
	
}
?>