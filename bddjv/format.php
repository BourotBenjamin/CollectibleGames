<?php

class format {


  private $id_format; 
  private $nom_format;
  private $logo_format;
  private $format_valide;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_format : ". $this->id_format . "
				   nom_format ". $this->nom_format. "
				   logo_format ". $this->logo_format;
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
    if (!isset($this->id_format)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_format)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_format set nom_format=".(isset($this->nom_format) ? "'$this->nom_format'" : "null").",
	".(isset($this->logo_format) ?'logo_format="'.$this->logo_format.'",':"")."
	format_valide=".(isset($this->format_valide) ? "'$this->format_valide'" : "0")."
				where id_format=$this->id_format";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update bddjv_format set format_valide='1' where id_format=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }

  
    
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('logo_format');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_version_jeu set id_format=$new where id_format=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_format WHERE id_format=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }





  public function delete() {
     $query = "DELETE FROM bddjv_format WHERE id_format =".$this->id_format;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->logo_format=="")
	{
		$this->logo_format='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_format VALUES (null, '".$this->nom_format."', '".$this->logo_format."', '".$this->format_valide."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_format' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_format) {
	  
	  $query = "select * from bddjv_format where id_format=".$id_format;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_format', $d->id_format);
	  $b->setAttr('nom_format', $d->nom_format);
	  $b->setAttr('logo_format', $d->logo_format);
	  $b->setAttr('format_valide', $d->format_valide);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_format ORDER BY nom_format';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_format',$row['id_format']);
			$temp->setAttr('nom_format',$row['nom_format']);
			$temp->setAttr('logo_format',$row['logo_format']);
			$temp->setAttr('format_valide',$row['format_valide']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_format) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_format where nom_format='".$nom_format."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_format',$row['id_format']);
			$temp->setAttr('nom_format',$row['nom_format']);
			$temp->setAttr('logo_format',$row['logo_format']);
			$temp->setAttr('format_valide',$row['format_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findNonValide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_format where format_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_format',$row['id_format']);
			$temp->setAttr('nom_format',$row['nom_format']);
			$temp->setAttr('logo_format',$row['logo_format']);
			$temp->setAttr('format_valide',$row['format_valide']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_format` WHERE `id_format` NOT IN (SELECT id_format FROM bddjv_version_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_format']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_format',$row['id_format']);
				$temp->setAttr('nom_format',$row['nom_format']);
				$temp->setAttr('logo_format',$row['logo_format']);
				$temp->setAttr('format_valide',$row['format_valide']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
	
	public static function findAllInPlateforme($id)
	{
		$tab = array();
		$db = Base::getConnection();
		$query = 'SELECT DISTINCT * FROM bddjv_format 
		WHERE id_format  IN
		(
			SELECT id_format
			FROM bddjv_jeu
			NATURAL JOIN bddjv_version_jeu
			WHERE id_plateforme='.$id.'
		)
		ORDER BY nom_format';
		foreach($db->query($query) as $row)
		{
				$temp = new self();
				$temp->setAttr('id_format',$row['id_format']);
				$temp->setAttr('nom_format',$row['nom_format']);
				$temp->setAttr('logo_format',$row['logo_format']);
				$temp->setAttr('format_valide',$row['format_valide']);
				$tab[] = $temp;
		}
		return $tab;
    }
}
?>