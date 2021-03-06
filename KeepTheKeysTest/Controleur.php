<?php
//include du fichier GESTION pour les objets (Modeles)
include ('modeles/gestionConteneur.php');


//classe CONTROLEUR qui redirige vers les bonnes vues les bonnes informations
class Controleur
	{
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------ATTRIBUTS PRIVES-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $monControleur;
	
	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function __construct(){
		$this->monControleur = new gestionConteneur();	
		
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------METHODE D'AFFICHAGE DE L'ENTETE-----------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function afficheEntete(){
		//appel de la vue de l'entête
		require 'vues/entete.php';
		}
		
		
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------	
	//---------------------------METHODE D'AFFICHAGE DU PIED DE PAGE------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function affichePiedPage(){
		//appel de la vue du pied de page
		require 'vues/piedPage.php';
		}
		
		
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------METHODE D'AFFICHAGE DU MENU-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function afficheMenu(){
		//appel de la vue du menu
		require 'vues/menu.php';
		}

	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------METHODE D'AFFICHAGE DES PAGES-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	public function affichePage($action,$vue){
		//SELON la vue demandée
		switch ($vue)
			{
			case "ajoutClef":
				$this->vueAjoutClef($action);
				break;
			case "consultationClef":
				$this->vueConsultationClef($action);
				break;
			case "accueil":
				session_destroy();
				break;
			}
		}
		
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------AJOUTCLEF--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueAjoutClef($action){
		//SELON l'action demandée
		switch ($action)
			{	
			
			//CAS ajout d'un pack de clefs---------------------------------------------------------------------------------------------------------
			case "ajouter" :
				include ('vues/formulaireNvlleClef.php');
				break;
				
			//CAS validation des clefs ajouter---------------------------------------------------------------------------------------------------------
			case "validerCreationClef" :
				//On traite le fichier XML (VERIFICATION DU FICHIER PREALABLE)
				$extension = strrchr($_FILES['fichierXML']['name'], '.');
				If($extension == '.xml'){
					$fichier = $_FILES['fichierXML']['tmp_name'];
					$uneReservation = $_POST['reserve'];
					$this->monControleur->litFichierXml($fichier,$uneReservation);
					include ('vues/validerCreationClef.php');
					break;
					}
				Else {
					$_SESSION['erreur']="Vous devez selectionner un fichier .XML";
					$_SESSION['redirection']="index.php?vue=ajoutClef&action=ajouter";
					include ('vues/erreur.php');
					}
			}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------CONSULTATIONCLEF--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueConsultationClef($action){
		//appel de la vue de la page de consultation des clefs
		

		switch($action)
			{
			case "Recherche":
			$_SESSION['listeProfesseur']=$this->monControleur->getToutLesProfesseursEnListeDeroulanteAffichage();
			$_SESSION['listeLogiciel'] = $this->monControleur->getToutLesLogicielsEnListeDeroulanteAffichage();
			
			require 'vues/consultation.php';
			break;
			case "Affichage":
				
				$leLogiciel=$_POST['logiciel'];
				$leProfesseur=$_POST['Professeur']; 
				if ($leLogiciel!=0 OR $leProfesseur!=0){
					$_SESSION['resultat']=$this->monControleur->remplitTableauRechercheClef($leLogiciel,$leProfesseur);
					require 'vues/resultatRechercheClef.php';
				}
				else {
					$_SESSION['erreur']="Vous devez selectionner au moins un critere pour la recherche.";
					$_SESSION['redirection']="index.php?vue=consultationClef&action=Recherche";
					include ('vues/erreur.php');
				}
			break;
			}	
	}	
	
	}