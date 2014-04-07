<?php

class plateforme {


  private $id_plateforme; 
  private $nom_plateforme;
  private $logo_plateforme;
  private $id_editeur; 
  private $description_plateforme; 
  private $plateforme_valide; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_plateforme : ". $this->id_plateforme . "
					nom_plateforme : ". $this->nom_plateforme . "
					logo_plateforme : ". $this->logo_plateforme . "
				   id_editeur ". $this->id_editeur;
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
    if (!isset($this->id_plateforme)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_plateforme)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_plateforme set nom_plateforme=".(isset($this->nom_plateforme) ? "'$this->nom_plateforme'" : "").",
	".(isset($this->logo_plateforme) ?'logo_plateforme="'.$this->logo_plateforme.'",':"")."
	id_editeur=".(isset($this->id_editeur) ? "'$this->id_editeur'" : "''").",
	description_plateforme=".(isset($this->description_plateforme) ? "'$this->description_plateforme'" : "''").",
	plateforme_valide=".(isset($this->plateforme_valide) ? "'$this->plateforme_valide'" : "0")."
				where id_plateforme=$this->id_plateforme;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_plateforme set plateforme_valide='1' where id_plateforme=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_plateforme');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_plateforme=$new where id_plateforme=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_plateforme WHERE id_plateforme=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_plateforme WHERE id_plateforme =".$this->id_plateforme;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_plateforme=="")
	{
		$this->logo_plateforme='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_plateforme VALUES (null, '".$this->nom_plateforme."', '".$this->id_editeur."', '".$this->logo_plateforme."', '".$this->description_plateforme."', '".$this->plateforme_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_plateforme' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_plateforme) {
	  
	  $query = "select * from bddjv_plateforme where id_plateforme=".$id_plateforme;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      if ($dbres!=null) {
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_plateforme', $d->id_plateforme);
	  $b->setAttr('nom_plateforme', $d->nom_plateforme);
	  $b->setAttr('logo_plateforme', $d->logo_plateforme);
	  $b->setAttr('id_editeur', $d->id_editeur);
	  $b->setAttr('description_plateforme', $d->description_plateforme);
	  $b->setAttr('plateforme_valide', $d->plateforme_valide);
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
	$query = 'SELECT * FROM bddjv_plateforme ORDER BY nom_plateforme';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('nom_plateforme',$row['nom_plateforme']);
			$temp->setAttr('logo_plateforme',$row['logo_plateforme']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('description_plateforme',$row['description_plateforme']);
			$temp->setAttr('plateforme_valide',$row['plateforme_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_plateforme) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_plateforme where nom_plateforme='".$nom_plateforme."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('nom_plateforme',$row['nom_plateforme']);
			$temp->setAttr('logo_plateforme',$row['logo_plateforme']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('description_plateforme',$row['description_plateforme']);
			$temp->setAttr('plateforme_valide',$row['plateforme_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findByMarque($id_editeur) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_plateforme where id_editeur='".$id_editeur."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('nom_plateforme',$row['nom_plateforme']);
			$temp->setAttr('logo_plateforme',$row['logo_plateforme']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('description_plateforme',$row['description_plateforme']);
			$temp->setAttr('plateforme_valide',$row['plateforme_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_plateforme NATURAL JOIN bddjv_editeur where plateforme_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('nom_plateforme',$row['nom_plateforme']);
			$temp->setAttr('logo_plateforme',$row['logo_plateforme']);
			$temp->setAttr('id_editeur',$row['nom_editeur']);
			$temp->setAttr('description_plateforme',$row['description_plateforme']);
			$temp->setAttr('plateforme_valide',$row['plateforme_valide']);
			$tab[] = $temp;
		}
		return $tab;
		
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_plateforme` WHERE `id_plateforme` NOT IN (SELECT id_plateforme FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_plateforme']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_plateforme',$row['id_plateforme']);
				$temp->setAttr('nom_plateforme',$row['nom_plateforme']);
				$temp->setAttr('logo_plateforme',$row['logo_plateforme']);
				$temp->setAttr('id_editeur',$row['nom_editeur']);
				$temp->setAttr('description_plateforme',$row['description_plateforme']);
				$temp->setAttr('plateforme_valide',$row['plateforme_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_plateforme 
		WHERE id_plateforme IN
		(
			SELECT bddjv_autre_plateforme_jeu.id_plateforme
			FROM bddjv_jeu
			JOIN bddjv_autre_plateforme_jeu
			WHERE bddjv_jeu.id_plateforme='.$id.'
			AND bddjv_jeu.id_jeu=bddjv_autre_plateforme_jeu.id_jeu
		)
		ORDER BY nom_plateforme';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_plateforme',$row['id_plateforme']);
				$temp->setAttr('nom_plateforme',$row['nom_plateforme']);
				$temp->setAttr('logo_plateforme',$row['logo_plateforme']);
				$temp->setAttr('plateforme_valide',$row['plateforme_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
	
}
?>