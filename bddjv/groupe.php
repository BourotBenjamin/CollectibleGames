<?php

class Groupe {


  private $id_groupe; 
  private $nom_groupe;
  private $logo_groupe;
  private $id_groupe_parent; 
  private $groupe_valide; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_groupe : ". $this->id_groupe . "
					nom_groupe : ". $this->nom_groupe . "
					logo_groupe : ". $this->logo_groupe . "
				   id_groupe_parent ". $this->id_groupe_parent. "
				   groupe_valide ". $this->groupe_valide;
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
    if (!isset($this->id_groupe)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_groupe)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_groupe set nom_groupe=".(isset($this->nom_groupe) ? "'$this->nom_groupe'" : "").",
	".(isset($this->logo_groupe) ?'logo_groupe="'.$this->logo_groupe.'",':"")."
	id_groupe_parent=".(isset($this->id_groupe_parent) ? "'$this->id_groupe_parent'" : "0").",
	groupe_valide=".(isset($this->groupe_valide) ? "'$this->groupe_valide'" : "'0'")."
				where id_groupe=$this->id_groupe";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_groupe set groupe_valide='1' where id_groupe=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_groupe');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_groupe=$new where id_groupe=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query = "update bddjv_groupe set id_groupe_parent=$new where id_groupe_parent=$old;";
    $nb+=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_groupe WHERE id_groupe=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_groupe WHERE id_groupe =".$this->id_groupe;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_groupe=="")
	{
		$this->logo_groupe='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_groupe VALUES (null, '".$this->nom_groupe."', '".$this->logo_groupe."', '".$this->id_groupe_parent."', '".$this->groupe_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_groupe' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_groupe) {
	  
	  $query = "select * from bddjv_groupe where id_groupe=".$id_groupe;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_groupe', $id_groupe);
	  $b->setAttr('nom_groupe', $d->nom_groupe);
	  $b->setAttr('logo_groupe', $d->logo_groupe);
	  $b->setAttr('id_groupe_parent', $d->id_groupe_parent);
	  $b->setAttr('groupe_valide', $d->groupe_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_groupe ORDER BY nom_groupe';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('nom_groupe',$row['nom_groupe']);
			$temp->setAttr('logo_groupe',$row['logo_groupe']);
			$temp->setAttr('id_groupe_parent',$row['id_groupe_parent']);
			$temp->setAttr('groupe_valide',$row['groupe_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_groupe) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_groupe where nom_groupe='".$nom_groupe."'" ;
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('nom_groupe',$row['nom_groupe']);
			$temp->setAttr('logo_groupe',$row['logo_groupe']);
			$temp->setAttr('id_groupe_parent',$row['id_groupe_parent']);
			$temp->setAttr('groupe_valide',$row['groupe_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_groupe where groupe_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_groupe',$row['id_groupe']);
			$temp->setAttr('nom_groupe',$row['nom_groupe']);
			$temp->setAttr('logo_groupe',$row['logo_groupe']);
			$temp->setAttr('id_groupe_parent',$row['id_groupe_parent']);
			$temp->setAttr('groupe_valide',$row['groupe_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_groupe` WHERE `id_groupe` NOT IN (SELECT id_groupe FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_groupe']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_groupe',$row['id_groupe']);
				$temp->setAttr('nom_groupe',$row['nom_groupe']);
				$temp->setAttr('logo_groupe',$row['logo_groupe']);
				$temp->setAttr('id_groupe_parent',$row['id_groupe_parent']);
				$temp->setAttr('groupe_valide',$row['groupe_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_groupe 
		WHERE id_groupe  IN
		(
			SELECT id_groupe
			FROM bddjv_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_groupe';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_groupe',$row['id_groupe']);
				$temp->setAttr('nom_groupe',$row['nom_groupe']);
				$temp->setAttr('logo_groupe',$row['logo_groupe']);
				$temp->setAttr('id_groupe_parent',$row['id_groupe_parent']);
				$temp->setAttr('groupe_valide',$row['groupe_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>