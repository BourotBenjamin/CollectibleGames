<?php

class editeur {


  private $id_editeur; 
  private $nom_editeur;
  private $logo_editeur;
  private $editeur_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_editeur : ". $this->id_editeur . "
				   nom_editeur ". $this->nom_editeur. "
				   logo_editeur ". $this->logo_editeur. "
				   editeur_valide ". $this->editeur_valide;
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
    if (!isset($this->id_editeur)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    
    if (!isset($this->id_editeur)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_editeur set nom_editeur=".(isset($this->nom_editeur) ? "'$this->nom_editeur'" : "null").",
	".(isset($this->logo_editeur) ?'logo_editeur="'.$this->logo_editeur.'",':"")."
	editeur_valide=".(isset($this->editeur_valide) ? "'$this->editeur_valide'" : "0")."
				where id_editeur=$this->id_editeur";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_editeur set editeur_valide='1' where id_editeur=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_editeur');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_version_jeu set id_editeur=$new where id_editeur=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query = "update bddjv_plateforme set id_editeur=$new where id_editeur=$old;";
    $nb+=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_editeur WHERE id_editeur=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }


  public function delete() {
     $query = "DELETE FROM bddjv_editeur WHERE id_editeur =".$this->id_editeur;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
    if($this->logo_editeur=="")
	{
		$this->logo_editeur='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_editeur VALUES (null, '".$this->nom_editeur."','".$this->logo_editeur."','".$this->editeur_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_editeur' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_editeur) {
	  
	  $query = "select * from bddjv_editeur where id_editeur=".$id_editeur;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      if ($dbres!=null) {
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_editeur', $d->id_editeur);
	  $b->setAttr('nom_editeur', $d->nom_editeur);
	  $b->setAttr('logo_editeur', $d->logo_editeur);
	  $b->setAttr('editeur_valide', $d->editeur_valide);
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
	$query = 'SELECT * FROM bddjv_editeur ORDER BY nom_editeur';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('nom_editeur',$row['nom_editeur']);
			$temp->setAttr('logo_editeur',$row['logo_editeur']);
			$temp->setAttr('editeur_valide',$row['editeur_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	    public static function findAllMarques() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT bddjv_editeur.id_editeur, nom_editeur, logo_editeur
FROM bddjv_plateforme
NATURAL JOIN bddjv_editeur
GROUP BY bddjv_editeur.id_editeur
ORDER BY nom_editeur';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('nom_editeur',$row['nom_editeur']);
			$temp->setAttr('logo_editeur',$row['logo_editeur']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_editeur) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_editeur where nom_editeur='".$nom_editeur."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('nom_editeur',$row['nom_editeur']);
			$temp->setAttr('logo_editeur',$row['logo_editeur']);
			$temp->setAttr('editeur_valide',$row['editeur_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_editeur where editeur_valide=0 " ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('nom_editeur',$row['nom_editeur']);
			$temp->setAttr('logo_editeur',$row['logo_editeur']);
			$temp->setAttr('editeur_valide',$row['editeur_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_editeur` WHERE `id_editeur` NOT IN (SELECT id_editeur FROM bddjv_version_jeu) AND `id_editeur` NOT IN (SELECT id_editeur FROM bddjv_plateforme);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_editeur']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_editeur',$row['id_editeur']);
				$temp->setAttr('nom_editeur',$row['nom_editeur']);
				$temp->setAttr('logo_editeur',$row['logo_editeur']);
				$temp->setAttr('editeur_valide',$row['editeur_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_editeur 
		WHERE id_editeur  IN
		(
			SELECT id_editeur
			FROM bddjv_jeu
			NATURAL JOIN bddjv_version_jeu
			WHERE id_plateforme='.$id.'
		)
		OR id_editeur  IN
		(
			SELECT id_editeur
			FROM bddjv_console
			NATURAL JOIN bddjv_version_console
			WHERE id_plateforme='.$id.'
		)
		OR id_editeur  IN
		(
			SELECT id_editeur
			FROM bddjv_accessoire
			NATURAL JOIN bddjv_version_accessoire
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_editeur';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_editeur',$row['id_editeur']);
				$temp->setAttr('nom_editeur',$row['nom_editeur']);
				$temp->setAttr('logo_editeur',$row['logo_editeur']);
				$temp->setAttr('editeur_valide',$row['editeur_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>