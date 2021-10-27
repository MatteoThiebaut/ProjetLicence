<?php

    include_once "./Model/bdd.php";
    include_once "./Model/user.php";
    $bdd = new Bdd();
    // $user = new User();

    if (isset($_POST['submitform'])){
    	if (isset($_POST['identifiant'])){
    		$username = htmlspecialchars($_POST['identifiant']);
    		$password = htmlspecialchars($_POST['password']);

    		$bdd->_connexion($username, $password);
    	}
    }
    
    $title = "Login | AllForSport";

    include_once "./View/index.php";
?>

