<?php

class developpeur {


  private $id_developpeur; 
  private $nom_developpeur;
  private $logo_developpeur;
  private $developpeur_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_developpeur : ". $this->id_developpeur . "
				   nom_developpeur ". $this->nom_developpeur. "
				   logo_developpeur ". $this->logo_developpeur. "
				   developpeur_valide ". $this->developpeur_valide;
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
    if (!isset($this->id_developpeur)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    
    if (!isset($this->id_developpeur)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_developpeur set nom_developpeur=".(isset($this->nom_developpeur) ? "'$this->nom_developpeur'" : "null").",
	".(isset($this->logo_developpeur) ?'logo_developpeur="'.$this->logo_developpeur.'",':"")."
	 developpeur_valide=".(isset($this->developpeur_valide) ? "'$this->developpeur_valide'" : "0")."
				where id_developpeur=$this->id_developpeur";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_developpeur set developpeur_valide='1' where id_developpeur=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_developpeur');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_developpeur=$new where id_developpeur=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_developpeur WHERE id_developpeur =$old";
    $pdo->exec($save_query);
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_developpeur WHERE id_developpeur =".$this->id_developpeur;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
    if($this->logo_developpeur=="")
	{
		$this->logo_developpeur='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_developpeur VALUES (null, '".$this->nom_developpeur."', '".$this->logo_developpeur."', '".$this->developpeur_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_developpeur' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_developpeur) {
	  
	  $query = "select * from bddjv_developpeur where id_developpeur=".$id_developpeur;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_developpeur', $d->id_developpeur);
	  $b->setAttr('nom_developpeur', $d->nom_developpeur);
	  $b->setAttr('logo_developpeur', $d->logo_developpeur);
	  $b->setAttr('developpeur_valide', $d->developpeur_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_developpeur ORDER BY nom_developpeur';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nom_developpeur',$row['nom_developpeur']);
			$temp->setAttr('logo_developpeur',$row['logo_developpeur']);
			$temp->setAttr('developpeur_valide',$row['developpeur_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findAllInPlateforme($id) {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT DISTINCT * FROM bddjv_developpeur 
	WHERE id_developpeur IN
	(
		SELECT id_developpeur
		FROM bddjv_jeu
		WHERE id_plateforme='.$id.'
	)
	ORDER BY nom_developpeur';
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nom_developpeur',$row['nom_developpeur']);
			$temp->setAttr('logo_developpeur',$row['logo_developpeur']);
			$temp->setAttr('developpeur_valide',$row['developpeur_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_developpeur) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_developpeur where nom_developpeur='".$nom_developpeur."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nom_developpeur',$row['nom_developpeur']);
			$temp->setAttr('logo_developpeur',$row['logo_developpeur']);
			$temp->setAttr('developpeur_valide',$row['developpeur_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_developpeur where developpeur_valide=0 LIMIT 501" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_developpeur',$row['id_developpeur']);
			$temp->setAttr('nom_developpeur',$row['nom_developpeur']);
			$temp->setAttr('logo_developpeur',$row['logo_developpeur']);
			$temp->setAttr('developpeur_valide',$row['developpeur_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_developpeur` WHERE `id_developpeur` NOT IN (SELECT id_developpeur FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_developpeur']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_developpeur',$row['id_developpeur']);
				$temp->setAttr('nom_developpeur',$row['nom_developpeur']);
				$temp->setAttr('logo_developpeur',$row['logo_developpeur']);
				$temp->setAttr('developpeur_valide',$row['developpeur_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
}
?>