<?php
Class Clef
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $codeClef;
	private $codeLotClef;
	private $Clef;
	private $utilisation;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unCodeClef, $unCodeLotClef, $uneClef, $uneUtilisation){
		$this->codeClef 	= $unCodeClef;
		$this->codeLotClef 	= $unCodeLotClef;
		$this->Clef 		= $uneClef;
		$this->reservation 	= $uneUtilisation;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getClef(){
		return $this->codeClef;
		}
		
	public function getLotClef(){
		return $this->codeLotClef;
		}
		
	public function getReservation(){
		return $this->reservation;
		}
	}
	
?>