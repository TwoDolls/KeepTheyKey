	<?php
include '/../Metier/Logiciel.php';

Class conteneurLogiciel
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesLogiciels;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct(){
		$this->lesLogiciels = new arrayObject();
		}
	
	//Getteur du tableau
	
	//METHODE AJOUTANT UN LOGICIEL-----------------------------------------------------------------------------------
	public function ajouteUnLogiciel($unCode, $unLibelle){
		$unLogiciel = new Logiciel ($unCode, $unLibelle);
		$this->lesLogiciels->append($unLogiciel);
		}
		
	//METHODE RETOURNANT LE NOMBRE DE LOGICIELS------------------------------------------------------------------
	public function nbLogiciels(){
		return $this->lesLogiciels->count();
		}

	//METHODE RETOURNANT LA LISTE DES LOGICIELS EN LISTE DEROULANTE -------------------------------------------------------------------------------------------------------
	public function getToutLesLogicielsEnListeDeroulanteAffichage(){
		$liste = '<SELECT name="logiciel"> <OPTION value=0> selectionnez un Logiciel </option>';
		foreach ($this->lesLogiciels as $unLogiciel){
			$liste.= '<OPTION value="'.$unLogiciel->getCodeLogiciel().'">'.$unLogiciel->getLibelle().'</OPTION>';
			}
		return $liste.'</SELECT>';
		}
		
	//METHODE VERIFIANT SI LE LOGICIEL EXISTE
	public function logicielExiste($unLogiciel){
		$B = False;
		$i = 0;
		$nbLogiciels = $this->nbLogiciels();
		while (($B == False) AND ($i < $nbLogiciels)){
			if ($this->lesLogiciels[$i]->getLibelle() == $unLogiciel){
				$B = True;
				}
			$i++;
			}
		return $B;
		}
		
	//METHODE DONNANT LE CODE D'APRES UN LIBELLE (en partant du principe que ce logiciel existe bel & bien
	public function chercheCodeLogicielDepuisLeLibelle($unLibelle){
		$B = False;
		$i = 0;
		$nbLogiciels = $this->nbLogiciels();
		while (($B == False) AND ($i < $nbLogiciels)){
			if ($this->lesLogiciels[$i]->getLibelle() == $unLibelle){
				$resultat = $this->lesLogiciels[$i]->getCodeLogiciel();
				$B = True;
				}
			$i++;
			}
		return $resultat;
		}
		// METHODE PERMETTANT DE RETROUVER LE LIBELLE D'UN LOGICIEL VIA SON CODE 
	public function getLibelleLogicielViaSonCode($unCode){
		$bool=false; $i=0; $libelle='';
		while($bool==false AND $i<$this->lesLogiciels->count()) {
			if ($this->lesLogiciels[$i]->getCodeLogiciel()==$unCode){
				$libelle=$this->lesLogiciels[$i]->getLibelle();
				$bool=true;
				}
			$i++;
			}
		return $libelle;
		}
	}