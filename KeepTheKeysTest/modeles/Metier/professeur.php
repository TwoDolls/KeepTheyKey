<?php

Class Professeur
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $codeUtilisateur;
	private $nom;
	private $prenom;
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unCode,$unNom,$unPrenom){
		$this->codeUtilisateur = $unCode;
		$this->nom = $unNom;
		$this->prenom = $unPrenom;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getCodeProfesseur(){
		return $this->codeUtilisateur;
		}
		
	public function getNom(){
		return $this->nom;
		}
	public function getPrenom(){
		return $this->prenom;
		}
	}
	
?>
