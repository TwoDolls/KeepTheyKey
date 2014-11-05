<?php
include 'Conteneur/conteneurLogiciel.php';
include 'Conteneur/conteneurProfesseur.php';
include 'Conteneur/conteneurLotClef.php';
include 'Conteneur/conteneurClef.php';
include 'accesBD.php';

Class gestionConteneur
	{
	//ATTRIBUTS PRIVES---------------------------------------------------------------------------------------------------------------------------
	private $tousLesLogiciels;
	private $tousLesProfesseurs;
	private $tousLesLotsClefs;
	private $toutesLesClefs;
	private $maBD;
	
	//CONSTRUCTEUR--------------------------------------------------------------------------------------------------------------------------------
	public function __construct(){
		$this->tousLesLogiciels = new conteneurLogiciel();
		$this->tousLesProfesseurs = new conteneurProfesseur();
		$this->tousLesLotsClefs = new conteneurLotClef();
		$this->toutesLesClefs = new conteneurClef();
		$this->maBD = new accesBD();
		$this->chargeLesLogiciels();
		$this->chargeLesProfesseurs();
		$this->chargeLesLotsClefs();
		$this->chargeLesClefs();
		}
	
	//METHODES TRANSITOIRES D'AFFICHAGE DE LISTE DEROULANTE
	public function getToutLesLogicielsEnListeDeroulanteAffichage() {
		return $this->tousLesLogiciels->getToutLesLogicielsEnListeDeroulanteAffichage();
		}
	public function getToutLesProfesseursEnListeDeroulanteAffichage() {
		return $this->tousLesProfesseurs->getToutLesProfesseursEnListeDeroulanteAffichage();
		}

	//METHODE CHARGEANT TOUS LES LOGICIELS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function chargeLesLogiciels(){
		$resultat=$this->maBD->chargement('logiciel');
		$nb=0;
		while ($nb<sizeof($resultat)){
			//instanciation du logiciel et ajout de celui-ci dans la collection
			$this->tousLesLogiciels->ajouteUnLogiciel($resultat[$nb][0],$resultat[$nb][1]);
			$nb++;
			}
		}
	
	//METHODE INSERANT UN LOGICIELS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function ajouteUnLogiciel($unLibelle){
		//insertion du logiciel dans la base de données
		$unCode = $this->maBD->insertLogiciel($unLibelle);
		//instanciation du logiciel et ajout de celui-ci dans la collection
		$this->tousLesLogiciels->ajouteUnLogiciel($unCode,$unLibelle);
		return $unCode;
		}
	
	//METHODE CHARGEANT TOUS LES LOTS CLEFS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function chargeLesLotsClefs(){
		$resultat=$this->maBD->chargement('lot_key');
		$nb=0;
		while ($nb<sizeof($resultat)){
			//instanciation du lot de clef et ajout de celui-ci dans la collection
			$this->tousLesLotsClefs->ajouteUnLotClef($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3], $resultat[$nb][4]);
			$this->instancieLienLotClef($resultat[$nb][0]);
			$nb++;
			}
		
		}
		
	//METHODE POUR FAIRE LA LIAISON ENTRE LES LOTS DE CLEFS ET LEURS CLEFS
	private function instancieLienLotClef ($unCodeLotClef) {
		Foreach($this->tousLesLotsClefs as $unLotClef){
			If ($unLotClef->getCodeLotKey() == $unCodeLotClef){
				$unLotClef->instancieLesClefsDuLot($unCodeLotClef);
				}
			}
		}
	
	//METHODE INSERANT UN LOT CLEF----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function ajouteUnLotClef($uneDate, $unCodeProfesseur, $unCodeLogiciel, $uneReservation){
		//insertion du lot de clef dans la base de données
		$unCode = $this->maBD->insertLotClef($uneDate, $unCodeProfesseur, $unCodeLogiciel, $uneReservation);
		//instanciation du lot de clef et ajout de celui-ci dans la collection
		$this->tousLesLotsClefs->ajouteUnLotClef($unCode,$uneDate, $unCodeProfesseur, $unCodeLogiciel, $uneReservation);
		return $unCode;
		}
	
	//METHODE INSERANT UNE CLEF----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function ajouteUneClef ($unCode, $unCodeLotClef, $uneClef){
		//Insertion de la clef dans la base de données
		$this->maBD->insertClef($unCode, $unCodeLotClef, $uneClef);
		//Instanciation de la clef et ajout de celle-ci dans la collection
		$this->toutesLesClefs->ajouteUneClef($unCode,$unCodeLotClef,$uneClef, "oui");
		}
	
	//METHODE CHARGEANT TOUTES LES CLEFS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function chargeLesClefs(){
		$resultat=$this->maBD->chargement('Clef');
		$nb=0;
		while ($nb<sizeof($resultat)){
			//instanciation des clefs et ajout de celle-ci dans la collection
			$this->toutesLesClefs->ajouteUneClef($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2], $resultat[$nb][3]);
			$nb++;
			}
		}
	
	//METHODE CHARGEANT TOUS LES PROFESSEURS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function chargeLesProfesseurs(){
		$resultat=$this->maBD->chargement('professeur');
		$nb=0;
		while ($nb<sizeof($resultat)){
			//instanciation du professeur et ajout de celui-ci dans la collection
			$this->tousLesProfesseurs->ajouteUnProfesseur($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2]);
			$nb++;
			}
		}


	//METHODE INSERANT UN PROFESSEURS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function ajouteUnProfesseur($unCode, $unNom, $unPrenom){
		//insertion du professeur dans la base de données
		$unCode = $this->maBD->insertProfesseur($unCode, $unNom, $unPrenom);
		//instanciation du professeur et ajout de celui-ci dans la collection
		$this->tousLesProfesseurs->ajouteUnProfesseur($unCode, $unNom, $unPrenom);
		}	
	
	//METHODE POUR LIRE & ENREGISTRER LES DONNEES D'UN FICHIER XML
	public function litFichierXml($unFichier,$uneReservation){
			//Chargement du fichier XML
			$lotKey =  simplexml_load_file($unFichier);
			//Récupération des clefs
			$i = 0;
			foreach ($lotKey as $uneClef) {
			
				//Gestion du Logiciel
				$nomLogiciel = (string)$uneClef->attributes();
				//On vérifie si le logiciel existe et l'enregistre si nécessaire
				If ($this->tousLesLogiciels->logicielExiste($nomLogiciel) == False){
					$unCodeLogiciel = $this->ajouteUnLogiciel($nomLogiciel);
					}
				//S'il existe déjà alors on enregistre son code dans une variable pour la gestion du lot de clefs
				Else {
					$unCodeLogiciel = $this->tousLesLogiciels->chercheCodeLogicielDepuisLeLibelle($nomLogiciel);
					}
					
				//Gestion du lot de clefs
				$dateCreation = date("d-m-Y");
				//Code professeur à faire depuis l'AD mais bon pour le momement on fait comme ça :
				$tableCodeProfesseur = array("001","002","003","004","005");
				$aleatoire = rand(0,4);
				$codeProfesseur = $tableCodeProfesseur[$aleatoire];
				$unCodeLotClef = $this->ajouteUnLotClef($dateCreation, $codeProfesseur, $unCodeLogiciel,$uneReservation);
				
				//Gestion des clefs
				$i = 1;
				Foreach($uneClef->Key as $uneCle){
					$this->ajouteUneClef($i, $unCodeLotClef, $uneCle);
					$i++;
					}
				$this->instancieLienLotClef ($unCodeLotClef);
				}
			}
	// ---------------------------------------- METHODE RETOURNANT LE RESULTAT DE LA RECHERCHE DES LOTS CLEFS 
	public function remplitTableauRechercheClef($unLogiciel,$unProfesseur){
			$liste='Résultat de la recherche</BR></BR> <table border=5><tr><td>Logiciel</td><td>Professeur</td><td>Détails</td></tr>';
			$cheminImageDetails = '<img src="images/loupe.png" border="0" align="center"/>';
			$B=False;			
			//Si les deux param sont remplis
			if($unLogiciel!='0' AND $unProfesseur!='0'){
				foreach ($this->tousLesLotsClefs->getLesLotsClef() as $unLotClef) {
					if($unLotClef->getCodeLogiciel()==$unLogiciel AND $unLotClef->getCodeProfesseur()==$unProfesseur){
							$liste.="<tr><td>".$this->tousLesLogiciels->getLibelleLogicielViaSonCode($unLotClef->getCodeLogiciel())."</td><td>".$this->tousLesProfesseurs->getLibelleProfesseurViaSonCode($unLotClef->getCodeProfesseur()).'</td>'.'<td>'.$cheminImageDetails.'</td></tr>';
							$B = True;
					}
				}
			}
			else{
				// si seulement le logiciel est rempli 
				if($unLogiciel!='0'){
					foreach ($this->tousLesLotsClefs->getLesLotsClef() as $unLotClef) {
						if($unLotClef->getCodeLogiciel()==$unLogiciel){
							$liste.="<tr><td>".$this->tousLesLogiciels->getLibelleLogicielViaSonCode($unLotClef->getCodeLogiciel())."</td><td>".$this->tousLesProfesseurs->getLibelleProfesseurViaSonCode($unLotClef->getCodeProfesseur()).'</td>'.'<td>'.$cheminImageDetails.'</td></tr>';
							$B = True;
						}
					}		
				}
				// si seulement le professeur est donné. 
				else{
					foreach ($this->tousLesLotsClefs->getLesLotsClef() as $unLotClef) {
						if ($unLotClef->getCodeProfesseur()==$unProfesseur){
							$liste.="<tr><td>".$this->tousLesLogiciels->getLibelleLogicielViaSonCode($unLotClef->getCodeLogiciel())."</td><td>".$this->tousLesProfesseurs->getLibelleProfesseurViaSonCode($unLotClef->getCodeProfesseur()).'</td>'.'<td>'.$cheminImageDetails.'</td></tr>';
							$B = True;
						}
					}
				}
			}
			if ($B==False){
					$liste="Il n'existe pas de résultat pour cette recherche.";
			}
			else{
				$liste.='</table>';
			}

			return $liste;
		}
	
		}
			
?>