<?php

class Accessoire {


  private $id_accessoire; 
  private $nom_accessoire;
  private $id_plateforme;
  private $id_editeur;
  private $id_type_accessoire; 
  private $zone; 
  private $accessoire_valide; 
  private $remarque_accessoire; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_accessoire : ". $this->id_accessoire . "
					nom_accessoire : ". $this->nom_accessoire . "
					id_plateforme : ". $this->id_plateforme . "
					id_editeur : ". $this->id_editeur . "
				   id_type_accessoire ". $this->id_type_accessoire. "
				   zone ". $this->zone. "
				   accessoire_valide ". $this->accessoire_valide. "
				   remarque_accessoire ". $this->remarque_accessoire;
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
    if (!isset($this->id_accessoire)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_accessoire)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update bddjv_accessoire set nom_accessoire=".(isset($this->nom_accessoire) ? "'$this->nom_accessoire'" : "").",
	".(isset($this->id_editeur) ?'id_plateforme="'.$this->id_plateforme.'",':"")."
	".(isset($this->id_editeur) ?'id_editeur="'.$this->id_editeur.'",':"")."
	id_type_accessoire=".(isset($this->id_type_accessoire) ? "'$this->id_type_accessoire'" : "0").",
	zone=".(isset($this->zone) ? "'$this->zone'" : "'0'").",
	remarque_accessoire=".(isset($this->remarque_accessoire) ? "'$this->remarque_accessoire'" : "''")."
	".(isset($this->accessoire_valide) ? ", accessoire_valide='$this->accessoire_valide'" : "''")."
				where id_accessoire=$this->id_accessoire";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('id_editeur');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_accessoire=$new where id_accessoire=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query = "update bddjv_accessoire set id_type_accessoire=$new where id_type_accessoire=$old;";
    $nb+=$pdo->exec($save_query);
	$save_query ="DELETE FROM bddjv_accessoire WHERE id_accessoire=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM bddjv_accessoire WHERE id_accessoire =".$this->id_accessoire;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
	public static function validerAccessoire($id) {
     $query = "UPDATE bddjv_accessoire SET accessoire_valide='1' WHERE id_accessoire=".$id;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
  
	public static function supprimerAccessoire($id)
	{
	$db = Base::getConnection();
	$query = 'SELECT photo_accessoire
	FROM bddjv_version_accessoire 
	WHERE id_accessoire ='.$id;
	foreach($db->query($query) as $row)
	{
		if($row['photo_accessoire']!="" && $row['photo_accessoire']!="img/inconnu.png")
		{
			unlink($row['photo_accessoire']);
		}
	}
	 $db = Base::getConnection();
     $query = "DELETE FROM bddjv_accessoire WHERE id_accessoire =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_version_accessoire WHERE id_accessoire =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_jeu_inclus_accessoire WHERE id_accessoire =".$id;
	 $db->exec($query);
     $query = "DELETE FROM bddjv_console_inclus_accessoire WHERE id_accessoire =".$id;
	 $db->exec($query);
	}
								
  public function insert() {
	if($this->id_editeur=="")
	{
		$this->id_editeur='img/inconnu.png';
	}
  	$query = "INSERT INTO bddjv_accessoire VALUES (null, '".$this->nom_accessoire."', '".$this->id_plateforme."', '".$this->id_editeur."', '".$this->id_type_accessoire."', '".$this->zone."', '".$this->accessoire_valide."', '".$this->remarque_accessoire."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_accessoire' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }

    public static function findById($id_accessoire) {
	  
	  $query = "select * from bddjv_accessoire where id_accessoire=".$id_accessoire;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_accessoire', $d->id_accessoire);
	  $b->setAttr('nom_accessoire', $d->nom_accessoire);
	  $b->setAttr('id_plateforme', $d->id_plateforme);
	  $b->setAttr('id_editeur', $d->id_editeur);
	  $b->setAttr('id_type_accessoire', $d->id_type_accessoire);
	  $b->setAttr('zone', $d->zone);
	  $b->setAttr('accessoire_valide', $d->accessoire_valide);
	  $b->setAttr('remarque_accessoire', $d->remarque_accessoire);
	  
	  return $b;
    }

    public static function findDetails($id_accessoire) {
	  		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire NATURAL JOIN bddjv_editeur NATURAL JOIN bddjv_type_accessoire  where id_accessoire='".$id_accessoire."'" ;
	
		$temp = array();
		foreach($db->query($query) as $row)
		{
	  		$temp['id_accessoire']=$row['id_accessoire'];
	  		$temp['nom_accessoire']=$row['nom_accessoire'];
	  		$temp['id_plateforme']=$row['id_plateforme'];
	  		$temp['id_editeur']=$row['id_editeur'];
	  		$temp['id_type_accessoire']=$row['id_type_accessoire'];
	  		$temp['accessoire_valide']=$row['accessoire_valide'];
	  		$temp['zone']=($row['zone']==0?'Non':'Oui');
	  		$temp['nom_type_accessoire']=$row['nom_type_accessoire'];
	  		$temp['logo_type_accessoire']=$row['logo_type_accessoire'];
	  		$temp['nom_editeur']=$row['nom_editeur'];
	  		$temp['logo_editeur']=$row['logo_editeur'];
	  		$temp['remarque_accessoire']=$row['remarque_accessoire'];
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
		return $temp;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_accessoire ORDER BY id_accessoire DESC';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$temp->setAttr('nom_accessoire',$row['nom_accessoire']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
			$temp->setAttr('accessoire_valide',$row['accessoire_valide']);
			$temp->setAttr('remarque_accessoire',$row['remarque_accessoire']);
			$temp->setAttr('zone',($row['zone']==0?'Non':'Oui'));
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findAutocompleteValues() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_accessoire 
	JOIN bddjv_plateforme 
	WHERE bddjv_accessoire.id_plateforme = bddjv_plateforme.id_plateforme
	ORDER BY nom_accessoire';
	
	
		foreach($db->query($query) as $row)
		{
			$tab[] = $row['nom_accessoire']." (".$row['nom_plateforme'].")";
		}
		return $tab;

    }
	
	public static function findAllNames() {
    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM bddjv_accessoire 
	JOIN bddjv_plateforme 
	WHERE bddjv_accessoire.id_plateforme = bddjv_plateforme.id_plateforme
	ORDER BY nom_plateforme, nom_accessoire';
		foreach($db->query($query) as $row)
		{
			$tab2 = array();
			$tab2['nom'] = $row['nom_accessoire']." (".$row['nom_plateforme'].")";
			$tab2['id'] = $row['id_accessoire'];
			$tab[]=$tab2;
		}
		return $tab;
    }
	
	public static function findByName($nom_accessoire) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire where nom_accessoire='".$nom_accessoire."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('accessoire_valide',$row['accessoire_valide']);
	  		$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$temp->setAttr('nom_accessoire',$row['nom_accessoire']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
			$temp->setAttr('remarque_accessoire',$row['remarque_accessoire']);
			$temp->setAttr('zone',($row['zone']==0?'Non':'Oui'));
			$tab[] = $temp;
		}
		return $tab;
	}
	
	
	
	public static function findByNameAndPlat($nom_accessoire, $id_plateforme) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire where nom_accessoire='".$nom_accessoire."' and id_plateforme='".$id_plateforme."'" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('accessoire_valide',$row['accessoire_valide']);
	  		$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$temp->setAttr('nom_accessoire',$row['nom_accessoire']);
			$temp->setAttr('id_plateforme',$row['id_plateforme']);
			$temp->setAttr('id_editeur',$row['id_editeur']);
			$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
			$temp->setAttr('remarque_accessoire',$row['remarque_accessoire']);
			$temp->setAttr('zone',($row['zone']==0?'Non':'Oui'));
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findInvalide() {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select id_accessoire from bddjv_accessoire where accessoire_valide=0" ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_accessoire',$row['id_accessoire']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findUnused()
	{ 
	$tab = array();
	 $db = Base::getConnection();
	 $query = "SELECT * FROM `bddjv_accessoire` WHERE `id_accessoire` NOT IN (SELECT id_accessoire FROM bddjv_jeu);" ;
		foreach($db->query($query) as $row)
		{
			if($row['id_accessoire']!=0)
			{
				$temp = new self();
				$temp->setAttr('accessoire_valide',$row['accessoire_valide']);
				$temp->setAttr('id_accessoire',$row['id_accessoire']);
				$temp->setAttr('nom_accessoire',$row['nom_accessoire']);
				$temp->setAttr('id_plateforme',$row['id_plateforme']);
				$temp->setAttr('id_editeur',$row['id_editeur']);
				$temp->setAttr('id_type_accessoire',$row['id_type_accessoire']);
				$temp->setAttr('remarque_accessoire',$row['remarque_accessoire']);
				$temp->setAttr('zone',($row['zone']==0?'Non':'Oui'));
				$tab[] = $temp;
			}
		}
		return $tab;
	}
		
    public static function findAllDetails() {
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire 
	 NATURAL JOIN bddjv_editeur 
	 NATURAL JOIN bddjv_type_accessoire 
	 NATURAL JOIN bddjv_version_accessoire 
	 NATURAL JOIN bddjv_region
	 JOIN bddjv_plateforme
	 WHERE bddjv_plateforme.id_plateforme = bddjv_accessoire.id_plateforme" ;
	
		$tab = array();
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_accessoire']]))
			{
				$temp = $tab[$row['id_accessoire']]; 
				if(!isset($t2[$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divAccRegion" id="AccRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2[$row['nom_region']]=1;
					$tab[$row['id_accessoire']]=$temp;	
				} 
				
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['id_accessoire']=$row['id_accessoire'];
				$temp['nom_accessoire']=$row['nom_accessoire'];
				$temp['nom_type_accessoire']='<span class="divAccType" id="AccType'.str_replace(' ','_',$row['nom_type_accessoire']).'" name="'.$row['nom_type_accessoire'].'">'.$row['nom_type_accessoire'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2[$row['nom_region']]=1;
				$temp['nom_region']='<span class="divAccRegion" id="AccRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_plateforme']='<span class="divAccPlateforme" id="AccPlateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_editeur']='<span class="divAccEditeur" id="AccEditeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['zone']='<span class="divAccZone" id="AccZone'.($row['zone']==0?'Non':'Oui').'" name="'.($row['zone']==0?'Non':'Oui').'">'.($row['zone']==0?'Non':'Oui').'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$tab[$row['id_accessoire']]=$temp;			
			}
		}
		return $tab;

    }
	
	public static function findAllDetailsByPlateforme($id) {
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire 
	 NATURAL JOIN bddjv_editeur 
	 NATURAL JOIN bddjv_type_accessoire 
	 NATURAL JOIN bddjv_version_accessoire 
	 NATURAL JOIN bddjv_region
	 JOIN bddjv_plateforme
	 WHERE bddjv_plateforme.id_plateforme =".$id
	." AND bddjv_accessoire.id_plateforme=".$id ;
		$tab = array();
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_accessoire']]))
			{
				$temp = $tab[$row['id_accessoire']]; 
				if(!isset($t2[$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divAccRegion" id="AccRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2[$row['nom_region']]=1;
					$tab[$row['id_accessoire']]=$temp;	
				} 
				
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['id_accessoire']=$row['id_accessoire'];
				$temp['nom_accessoire']=$row['nom_accessoire'];
				$temp['nom_type_accessoire']='<span class="divAccType" id="AccType'.str_replace(' ','_',$row['nom_type_accessoire']).'" name="'.$row['nom_type_accessoire'].'">'.$row['nom_type_accessoire'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2[$row['nom_region']]=1;
				$temp['nom_region']='<span class="divAccRegion" id="AccRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_plateforme']='<span class="divAccPlateforme" id="AccPlateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_editeur']='<span class="divAccEditeur" id="AccEditeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['zone']='<span class="divAccZone" id="AccZone'.($row['zone']==0?'Non':'Oui').'" name="'.($row['zone']==0?'Non':'Oui').'">'.($row['zone']==0?'Non':'Oui').'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$tab[$row['id_accessoire']]=$temp;			
			}
		}
		return $tab;
    }		
	
	public static function findAllDetailsLiteByPlateforme($id) {
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire 
	 WHERE id_plateforme=".$id ;
		$tab = array();
		foreach($db->query($query) as $row)
		{
			$temp = array();
			$temp['id_accessoire']=$row['id_accessoire'];
			$temp['nom_accessoire']=$row['nom_accessoire'];
			$tab[$row['id_accessoire']]=$temp;			
		}
		return $tab;
    }		
	
    public static function findAllDetailsBySearch($name, $plat, $region, $editeur, $type, $zone) 
	{
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from bddjv_accessoire 
	 NATURAL JOIN bddjv_editeur 
	 NATURAL JOIN bddjv_type_accessoire 
	 NATURAL JOIN bddjv_version_accessoire 
	 NATURAL JOIN bddjv_region
	 JOIN bddjv_plateforme
	 WHERE bddjv_plateforme.id_plateforme = bddjv_accessoire.id_plateforme
	 AND nom_accessoire LIKE '%".$name."%'" 
	.(count($plat)>0?' AND bddjv_accessoire.id_plateforme IN('.implode(",",$plat).")":'')
	.(count($editeur)>0?' AND bddjv_accessoire.id_editeur IN('.implode(",",$editeur).")":'')
	.(count($region)>0?' AND id_region IN('.implode(",",$region).")":'') 
	.(count($type)>0?' AND id_type_accessoire IN('.implode(",",$type).")":'') 
	.(count($zone)==1?' AND zone IN('.implode(",",$zone).")":'') ;
		$tab = array();
		foreach($db->query($query) as $row)
		{
			if(isset($tab[$row['id_accessoire']]))
			{
				$temp = $tab[$row['id_accessoire']]; 
				if(!isset($t2[$row['nom_region']]))
				{
					$temp['nom_region']=$temp['nom_region'].' / <span class="divAccRegion" id="AccRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
					$t2[$row['nom_region']]=1;
					$tab[$row['id_accessoire']]=$temp;	
				} 
				
			}
			else
			{
				$temp = array();
				$t2 = array();
				$temp['id_accessoire']=$row['id_accessoire'];
				$temp['nom_accessoire']=$row['nom_accessoire'];
				$temp['nom_type_accessoire']='<span class="divAccType" id="AccType'.str_replace(' ','_',$row['nom_type_accessoire']).'" name="'.$row['nom_type_accessoire'].'">'.$row['nom_type_accessoire'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$t2[$row['nom_region']]=1;
				$temp['nom_region']='<span class="divAccRegion" id="AccRegion'.str_replace(' ','_',$row['nom_region']).'" name="'.$row['nom_region'].'">'.$row['nom_region'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_plateforme']='<span class="divAccPlateforme" id="AccPlateforme'.str_replace(' ','_',$row['nom_plateforme']).'" name="'.$row['nom_plateforme'].'">'.$row['nom_plateforme'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['nom_editeur']='<span class="divAccEditeur" id="AccEditeur'.str_replace(' ','_',$row['nom_editeur']).'" name="'.$row['nom_editeur'].'">'.$row['nom_editeur'].'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$temp['zone']='<span class="divAccZone" id="AccZone'.($row['zone']==0?'Non':'Oui').'" name="'.($row['zone']==0?'Non':'Oui').'">'.($row['zone']==0?'Non':'Oui').'<span id="info">Cliquez pour ajouter un filtre</span></span>';
				$tab[$row['id_accessoire']]=$temp;			
			}
		}
		return $tab;

    }
	
}
?>