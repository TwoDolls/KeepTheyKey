	<?php
include '/../Metier/professeur.php';

Class conteneurProfesseur
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesProfesseurs;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct(){
		$this->lesProfesseurs = new arrayObject();
		}
	
	//METHODE AJOUTANT UN PROFESSEUR-----------------------------------------------------------------------------------
	public function ajouteUnProfesseur($unCode, $unNom, $unPrenom){
		$unProfesseur = new professeur ($unCode, $unNom, $unPrenom);
		$this->lesProfesseurs->append($unProfesseur);
		}
		
	//METHODE RETOURNANT LE NOMBRE DE PROFESSEUR------------------------------------------------------------------
	public function nbProfesseur(){
		return $this->lesProfesseurs->count();
		}
		
	// METHODE RETOURNANT LA LISTE DES PROFESSEURS EN LISTE DEROULATE CONSULTATION----------------------------------------------------------------------------------------------
	public function getToutLesProfesseursEnListeDeroulanteAffichage(){
		$liste = '<SELECT name="Professeur"> <OPTION value=000> selectionnez un professeur </option>';
		foreach ($this->lesProfesseurs as $unProfesseur){
			$liste.= '<OPTION value="'.$unProfesseur->getCodeProfesseur().'">'.$unProfesseur->getNom().' '.$unProfesseur->getPrenom().'</OPTION>';
			}
		return $liste.'</SELECT>';
		}
		// METHODE PERMETTANT DE RETROUVER LE LIBELLE D'UN PROFESSEUR VIA SON CODE 
	public function getLibelleProfesseurViaSonCode($unCode){
		$bool=false; $i=0; $libelle='';
		while($bool==false AND $i<$this->lesProfesseurs->count()) {
			if ($this->lesProfesseurs[$i]->getCodeProfesseur()==$unCode){
				$libelle=$this->lesProfesseurs[$i]->getNom().' '.$this->lesProfesseurs[$i]->getPrenom();
				$bool=true;
				}
			$i++;
			}
		return $libelle;
		}
	}