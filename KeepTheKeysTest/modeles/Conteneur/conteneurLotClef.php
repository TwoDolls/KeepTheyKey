	<?php
include '/../Metier/lot_key.php';
Class conteneurLotClef
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesLotsClefs;
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct(){
		$this->lesLotsClefs = new arrayObject();
		}

	public function getLesLotsClef(){
		return $this->lesLotsClefs;
	}	
	
	//METHODE AJOUTANT D'UN LOT CLEF -----------------------------------------------------------------------------------
	public function ajouteUnLotClef($unCode, $uneDate, $unProfesseur, $unLogiciel, $unEtatReservation){
		$unLotClef = new Lot_Key ($unCode, $uneDate, $unProfesseur, $unLogiciel, $unEtatReservation);
		$this->lesLotsClefs->append($unLotClef);
		}		
	}
?>