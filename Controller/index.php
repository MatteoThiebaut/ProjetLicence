<?php

    include_once "./Model/bdd.php";
    $bdd = new Bdd();

    if (isset($_POST['submitform'])){
    	if (isset($_POST['identifiant'])){
    		$username = htmlspecialchars($_POST['identifiant']);
    		$password = htmlspecialchars($_POST['password']);

    		$bdd->getlogin($username, $password);
    	}
    }
    
    $title = "Login | AllForSport";

    include_once "./View/index.php";
?>

