<?php

class Commande {


  private $id_commande; 
  private $nom_commande;
  private $logo_commande;
  private $commande_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_commande : ". $this->id_commande . "
				   nom_commande ". $this->nom_commande. "
				   logo_commande ". $this->logo_commande;
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
    if (!isset($this->id_commande)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    
    if (!isset($this->id_commande)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_commande set nom_commande=".(isset($this->nom_commande) ? "'$this->nom_commande'" : "null").",
	".(isset($this->logo_commande) ?'logo_commande="'.$this->logo_commande.'",':"")."
	commande_valide=".(isset($this->commande_valide) ? "'$this->commande_valide'" : "0")."
				where id_commande=$this->id_commande";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_commande set commande_valide='1' where id_commande=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_commande');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_commande_jeu set id_commande=$new where id_commande=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_commande WHERE id_commande=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_commande WHERE id_commande =".$this->id_commande;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  	if($this->logo_commande=="")
	{
		$this->logo_commande='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_commande VALUES (null, '".$this->nom_commande."','".$this->logo_commande."','".$this->commande_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_commande' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_commande) {
	  
	  $query = "select * from bddjv_commande where id_commande=".$id_commande;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_commande', $d->id_commande);
	  $b->setAttr('nom_commande', $d->nom_commande);
	  $b->setAttr('logo_commande', $d->logo_commande);
	  $b->setAttr('commande_valide', $d->commande_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_commande ORDER BY nom_commande';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_commande',$row['id_commande']);
			$temp->setAttr('nom_commande',$row['nom_commande']);
			$temp->setAttr('logo_commande',$row['logo_commande']);
			$temp->setAttr('commande_valide',$row['commande_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_commande) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_commande where nom_commande='".$nom_commande."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_commande',$row['id_commande']);
			$temp->setAttr('nom_commande',$row['nom_commande']);
			$temp->setAttr('logo_commande',$row['logo_commande']);
			$temp->setAttr('commande_valide',$row['commande_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
		public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_commande where commande_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_commande',$row['id_commande']);
			$temp->setAttr('nom_commande',$row['nom_commande']);
			$temp->setAttr('logo_commande',$row['logo_commande']);
			$temp->setAttr('commande_valide',$row['commande_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_commande` WHERE `id_commande` NOT IN (SELECT id_commande FROM bddjv_commande_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_commande']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_commande',$row['id_commande']);
				$temp->setAttr('nom_commande',$row['nom_commande']);
				$temp->setAttr('logo_commande',$row['logo_commande']);
				$temp->setAttr('commande_valide',$row['commande_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_commande 
		WHERE id_commande  IN
		(
			SELECT id_commande
			FROM bddjv_jeu
			NATURAL JOIN bddjv_commande_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_commande';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_commande',$row['id_commande']);
				$temp->setAttr('nom_commande',$row['nom_commande']);
				$temp->setAttr('logo_commande',$row['logo_commande']);
				$temp->setAttr('commande_valide',$row['commande_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>