<?php

	function comptePlatefomes()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_plateforme;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteMarques()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_editeur WHERE id_editeur IN (SELECT DISTINCT id_editeur FROM bddjv_plateforme) AND id_editeur!=0;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteJeux()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_jeu;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteVersionsJeux()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_version_jeu;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteConsoles()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_console;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteVersionsConsoles()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_version_console;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteAccessoires()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_accessoire;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}
	function compteVersionsAccessoires()
	{ 
		$nb = 0;
		$db = Base::getConnection();
		$query = "SELECT COUNT(*) c FROM bddjv_version_accessoire;" ;
		foreach($db->query($query) as $row)
		{
			$nb = $row['c'];
		}
		return $nb;
	}

?>