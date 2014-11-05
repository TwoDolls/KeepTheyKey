<?php
Class Lot_Key
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $codeLotKey;
	private $dateCreation;
	private $codeProfesseur;
	private $codeLogiciel;
	private $lesClefs;
	private $etatReservation;
	private $maBD;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unCodeLotKey,$uneDateCreation,$unCodeProfesseur,$unCodeLogiciel,$unEtatReservation){
		$this->codeLotKey 		= $unCodeLotKey;
		$this->dateCreation 	= $uneDateCreation;
		$this->codeProfesseur 	= $unCodeProfesseur;
		$this->codeLogiciel 	= $unCodeLogiciel;
		$this->reserve 			= $unEtatReservation;
		$this->maBD 			= new accesBD();
		$this->lesClefs 		= new arrayObject();
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getCodeLotKey(){
		return $this->codeLotKey;
		}
		
	public function getDateCreation(){
		return $this->dateCreation;
		}
	public function getCodeProfesseur(){
		return $this->codeProfesseur;
		}
	public function getcodeLogiciel(){
		return $this->codeLogiciel;
		}
	public function getEtatReservation(){
		return $this->etatReservation;
		}
	
	//METHODE INSTANCIANT LES CLEFS AU LOT COURANT	
	public function instancieLesClefsDuLot($unCode){
		$resultat = $this->maBD->lesClefsDunLotClef($unCode);
		foreach ($resultat as $unResultat) {
			$unCodeClef = $unResultat[0];
			$unCodeLotClef = $unResultat[1];
			$uneClef=$unResultat[2];
			$uneClef= new clef($unCodeClef,$unCodeLotClef,$uneClef);
			$this->lesClefs->append($uneClef);
			}
		}
	}
	
?>