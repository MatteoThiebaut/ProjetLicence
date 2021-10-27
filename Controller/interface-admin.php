<?php

    include_once "./Model/bdd.php";
    include_once "./Model/user.php";
    $bdd = new Bdd();
    // $user = new User();

    if (isset($_SESSION['connect'])){
        if($_SESSION['connect'] == false){    	
            header('Location: ../Controller/index.php');
        }
    }
    
    $title = "Login | AllForSport";

    include_once "./View/index.php";
?>