<?php
include '/../Metier/Clef.php';
Class conteneurClef
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesClefs;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct(){
		$this->lesClefs = new arrayObject();
		}
	
	//METHODE AJOUTANT UNE CLEF-----------------------------------------------------------------------------------
	public function ajouteUneClef($unCode, $unCodeLot, $laClef, $uneUtilisation){
		$uneClef = new Clef ($unCode, $unCodeLot, $laClef, $uneUtilisation);
		$this->lesClefs->append($uneClef);
		}
	}
?>