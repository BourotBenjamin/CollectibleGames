<?php

class Console {


  private $id_console; 
  private $nom_console;
  private $id_plateforme;
  private $id_editeur;
  private $console_valide;
  private $remarque_console;

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_console : ". $this->id_console . "
				   nom_console ". $this->nom_console. "
				   id_plateforme ". $this->id_plateforme. "
				   id_editeur ". $this->id_editeur. "
				   console_valide ". $this->console_valide. "
				   remarque_console ". $this->remarque_console;
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
    if (!isset($this->id_console)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_console)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_console set nom_console=".(isset($this->nom_console) ? "'$this->nom_console'" : "null").",
	".(isset($this->id_plateforme) ?'id_plateforme="'.$this->id_plateforme.'",':"")."
	id_editeur=".(isset($this->id_editeur) ? "'$this->id_editeur'" : "0").",
	remarque_console=".(isset($this->remarque_console) ? "'$this->remarque_console'" : "0")."
				where id_console=$this->id_console";
     
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  

  public function delete() {
     $query = "DELETE FROM bddjv_console WHERE id_console =".$this->id_console;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
	public static function validerConsole($id) {
     $query = "UPDATE bddjv_console SET console_valide='1' WHERE id_console=".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
	public static function supprimerConsole($id)
	{
	$db = Base::getConnection();
	$query = 'SELECT photo_console
	 FROM bddjv_version_console
	 WHERE id_console ='.$id;
	foreach($db->query($query) as $row)
	{
		if($row['photo_console']!="" && $row['photo_console']!="img/inconnu.png")
		{
			unlink($row['photo_console']);
		}
	}
	 $db = Base::getConnection();
     $query = "DELETE FROM bddjv_console WHERE id_console =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_version_console WHERE id_console =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_console_inclus_jeu WHERE id_console =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_console_inclus_accessoire WHERE id_console =".$id;
	 $db->exec($query);
	}
		
								
  public function insert() {
	if($this->id_plateforme=="")
	{
		$this->id_plateforme='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_console VALUES (null, '".$this->nom_console."','".$this->id_plateforme."','".$this->id_editeur."', 0,'".$this->remarque_console."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_console' , $db->LastInsertId() );
	return  $this->id_console;
  }
		

 public static function findById($id_console) {
	$query = "select * from bddjv_console where id_console=".$id_console;
    $pdo = Base::getConnection();
    $dbres = $pdo->query($query);
    $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	$b = new self();
	$b->setAttr('id_console', $d->id_console);
	$b->setAttr('nom_console', $d->nom_console);
	$b->setAttr('id_plateforme', $d->id_plateforme);
	$b->setAttr('id_editeur', $d->id_editeur);
	$b->setAttr('console_valide', $d->console_valide);
	$b->setAttr('remarque_console', $d->remarque_console);
	return $b;
 }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_console ORDER BY id_console DESC';
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_console',$row['id_console']);
		$temp->setAttr('nom_console',$row['nom_console']);
		$temp->setAttr('id_plateforme',$row['id_plateforme']);
		$temp->setAttr('id_editeur',$row['id_editeur']);
		$temp->setAttr('console_valide',$row['console_valide']);
		$temp->setAttr('remarque_console',$row['remarque_console']);
		$tab[] = $temp;
	}
	return $tab;

    }
	
	public static function findByName($nom_console) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console where nom_console='".$nom_console."';" ;
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_console',$row['id_console']);
		$temp->setAttr('nom_console',$row['nom_console']);
		$temp->setAttr('id_plateforme',$row['id_plateforme']);
		$temp->setAttr('id_editeur',$row['id_editeur']);
		$temp->setAttr('console_valide',$row['console_valide']);
		$temp->setAttr('remarque_console',$row['remarque_console']);
		$tab[] = $temp;
	}
		return $tab;
	}
	
	public static function findNonValide() 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console where id_editeur=0" ;
	foreach($db->query($query) as $row)
	{
		$temp = new self();
	  	$temp->setAttr('id_console',$row['id_console']);
		$temp->setAttr('nom_console',$row['nom_console']);
		$temp->setAttr('id_plateforme',$row['id_plateforme']);
		$temp->setAttr('id_editeur',$row['id_editeur']);
		$temp->setAttr('console_valide',$row['console_valide']);
		$temp->setAttr('remarque_console',$row['remarque_console']);
		$tab[] = $temp;
	}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_console` WHERE `id_console` NOT IN (SELECT id_console FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_console']!=0)
			{
				$temp = new self();
				$temp->setAttr('id_console',$row['id_console']);
				$temp->setAttr('nom_console',$row['nom_console']);
				$temp->setAttr('id_plateforme',$row['id_plateforme']);
				$temp->setAttr('id_editeur',$row['id_editeur']);
				$temp->setAttr('console_valide',$row['console_valide']);
				$temp->setAttr('remarque_console',$row['remarque_console']);
				$tab[] = $temp;
			}
		}
		return $tab;
	}
		
    public static function findAllDetails() 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console
	 NATURAL JOIN bddjv_editeur 
	 NATURAL JOIN bddjv_version_console
	 NATURAL JOIN bddjv_region
	 JOIN bddjv_plateforme
	 WHERE bddjv_plateforme.id_plateforme = bddjv_console.id_plateforme" ;
	
		$tab = array();
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_console']]))
			{
				$temp = $tab[$row['id_console']]; 
				if(!isset($t2[$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divConRegion" id="ConRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2[$row['nom_region']]=1;
					$tab[$row['id_console']]=$temp;	
				} 
				
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['id_console']=$row['id_console'];
				$temp['console_valide']=$row['console_valide'];
				$temp['nom_console']=$row['nom_console'];
				$t2[$row['nom_region']]=1;
				$temp['nom_region']='<span class="divConRegion" id="ConRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_plateforme']='<span class="divConPlateforme" id="ConPlateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_editeur']='<span class="divConEditeur" id="ConEditeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$tab[$row['id_console']]=$temp;			
			}
		}
		return $tab;

    }
	
	public static function findAllDetailsByPlateforme($id) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console
	 NATURAL JOIN bddjv_editeur 
	 NATURAL JOIN bddjv_version_console
	 NATURAL JOIN bddjv_region
	 JOIN bddjv_plateforme
	 WHERE bddjv_plateforme.id_plateforme =".$id
	." AND bddjv_console.id_plateforme=".$id ;
		$tab = array();
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_console']]))
			{
				$temp = $tab[$row['id_console']]; 
				if(!isset($t2[$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divConRegion" id="ConRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2[$row['nom_region']]=1;
					$tab[$row['id_console']]=$temp;	
				} 
				
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['id_console']=$row['id_console'];
				$temp['console_valide']=$row['console_valide'];
				$temp['nom_console']=$row['nom_console'];
				$t2[$row['nom_region']]=1;
				$temp['nom_region']='<span class="divConRegion" id="ConRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_plateforme']='<span class="divConPlateforme" id="ConPlateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_editeur']='<span class="divConEditeur" id="ConEditeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$tab[$row['id_console']]=$temp;			
			}
		}
		return $tab;

    }
	
   public static function findAllDetailsLiteByPlateforme($id) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console
	 WHERE id_plateforme=".$id ;
		$tab = array();
		foreach($db->query($query) as $row)
		{
			$temp = array();
			$temp['id_console']=$row['id_console'];
			$temp['nom_console']=$row['nom_console'];
			$tab[$row['id_console']]=$temp;			
		}
		return $tab;
    }
   
    public static function findAllDetailsBySearch($name, $plat, $region, $editeur) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console
	 NATURAL JOIN bddjv_editeur 
	 NATURAL JOIN bddjv_version_console
	 NATURAL JOIN bddjv_region
	 JOIN bddjv_plateforme
	 WHERE bddjv_plateforme.id_plateforme = bddjv_console.id_plateforme
	 AND nom_console LIKE '%".$name."%'"
	.(count($plat)>0?' AND bddjv_console.id_plateforme IN('.implode(",",$plat).")":'')
	.(count($editeur)>0?' AND bddjv_console.id_editeur IN('.implode(",",$editeur).")":'')
	.(count($region)>0?' AND id_region IN('.implode(",",$region).")":'') ;
	
		$tab = array();
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_console']]))
			{
				$temp = $tab[$row['id_console']]; 
				if(!isset($t2[$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divConRegion" id="ConRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2[$row['nom_region']]=1;
					$tab[$row['id_console']]=$temp;	
				} 
				
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['id_console']=$row['id_console'];
				$temp['console_valide']=$row['console_valide'];
				$temp['nom_console']=$row['nom_console'];
				$t2[$row['nom_region']]=1;
				$temp['nom_region']='<span class="divConRegion" id="ConRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_plateforme']='<span class="divConPlateforme" id="ConPlateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_editeur']='<span class="divConEditeur" id="ConEditeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$tab[$row['id_console']]=$temp;			
			}
		}
		return $tab;

    }
	
   public static function findDetails($id_console) 
   {
	  		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_console NATURAL JOIN bddjv_editeur where id_console='".$id_console."'" ;
	
		$temp = array();
		foreach($db->query($query) as $row)
		{
	  		$temp['id_console']=$row['id_console'];
	  		$temp['nom_console']=$row['nom_console'];
	  		$temp['id_plateforme']=$row['id_plateforme'];
	  		$temp['id_editeur']=$row['id_editeur'];
	  		$temp['console_valide']=$row['console_valide'];
	  		$temp['nom_editeur']=$row['nom_editeur'];
	  		$temp['logo_editeur']=$row['logo_editeur'];
	  		$temp['remarque_console']=$row['remarque_console'];
		}
		if(isset($temp['id_plateforme']))
		{
			$query = "select * from bddjv_plateforme NATURAL JOIN bddjv_editeur where id_plateforme='".$temp['id_plateforme']."'" ;
			foreach($db->query($query) as $row)
			{
				$temp['nom_plateforme']=$row['nom_plateforme'];
				$temp['logo_plateforme']=$row['logo_plateforme'];
				$temp['nom_editeur_plateforme']=$row['nom_editeur'];
				$temp['id_editeur_plateforme']=$row['id_editeur'];
				$temp['logo_editeur_plateforme']=$row['logo_editeur'];
			}
		}
		$query = 'SELECT *
		FROM bddjv_console_inclus_accessoire
		NATURAL JOIN bddjv_accessoire
		JOIN bddjv_plateforme
		WHERE id_console='.$id_console.'
		AND bddjv_accessoire.id_plateforme = bddjv_plateforme.id_plateforme';
		$temp['accessoires'] = array();
		foreach($db->query($query) as $row)
		{
			$temp2 = array();
			$temp2['nom_accessoire'] = $row['nom_accessoire'];
			$temp2['nom_plateforme'] = $row['nom_plateforme'];
			$temp2['id_accessoire'] = $row['id_accessoire'];
			$temp['accessoires'][] = $temp2;
		}
		$query = 'SELECT *
		FROM bddjv_console_inclus_jeu
		NATURAL JOIN bddjv_jeu
		NATURAL JOIN bddjv_nom_jeu
		NATURAL JOIN bddjv_plateforme
		WHERE id_console='.$id_console;
		$temp['jeux'] = array();
		foreach($db->query($query) as $row)
		{
			$temp2 = array();
			$temp2['nom_jeu'] = $row['nom_jeu'];
			$temp2['nom_plateforme'] = $row['nom_plateforme'];
			$temp2['id_jeu'] = $row['id_jeu'];
			$temp['jeux'][] = $temp2;
		}
		return $temp;
    }
	
	public static function findInvalide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select id_console from bddjv_console where console_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_console',$row['id_console']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	
	public static function findAllNames() {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_console
	JOIN bddjv_plateforme 
	WHERE bddjv_console.id_plateforme = bddjv_plateforme.id_plateforme
	ORDER BY nom_plateforme, nom_console';
		foreach($db->query($query) as $row)
		{
			$tab2 = array();
			$tab2['nom'] = $row['nom_console']." (".$row['nom_plateforme'].")";
			$tab2['id'] = $row['id_console'];
			$tab[]=$tab2;
		}
		return $tab;
    }
}
?>