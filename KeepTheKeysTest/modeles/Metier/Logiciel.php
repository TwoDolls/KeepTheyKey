<?php

Class Logiciel
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $codeLogiciel;
	private $libelle;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unCodeLogiciel,$unLibelle){
		$this->codeLogiciel = $unCodeLogiciel;
		$this->libelle = $unLibelle;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getCodeLogiciel(){
		return $this->codeLogiciel;
		}
		
	public function getLibelle(){
		return $this->libelle;
		}
	}
	
?>