<?php
session_start();
//include du fichier CONTROLEUR
include 'Controleur.php';
//SI le controleur n'existe pas déjà, on l'instancie
if (!isset ($_SESSION['Controleur']))
	{
	$monControleur = new Controleur();
	$_SESSION['Controleur'] = serialize($monControleur);
	}
//SINON on le récupère de la SESSION
else
	{
	$monControleur = unserialize($_SESSION['Controleur']);
	}
//affichage de l'entête
$monControleur->afficheEntete();
//affichage du menu
$monControleur->afficheMenu();
//affichage des vues


//(définies grâce aux variables transmises à travers la méthode GET)
if ((isset($_GET['vue']))&& (isset($_GET['action'])))
	$monControleur->affichePage($_GET['action'],$_GET['vue']);
//affichage du pied de page
$monControleur->affichePiedPage();
?>