<?php

    include_once "./Model/bdd.php";
    include_once "./Model/user.php";
    $bdd = new Bdd();
    $title = "Page administrateur";

    // Vérification que l'utilisateur est connecté
    if (isset($_SESSION['connect'])){
        if($_SESSION['connect'] == false){    	
            header('Location: ./Controller/index.php');
        }
    }

    if (isset($_POST['inscription'])){
    	if (isset($_POST['profil']) && isset($_POST['email']) && isset($_POST['identifiant']) && isset($_POST['password']) ){
    		$username = htmlspecialchars($_POST['identifiant']);
    		$password = htmlspecialchars($_POST['password']);

    		$bdd->_inscription($username, $_POST['profil'], $password, $_POST['email']);
    	}
    }
    
    if (isset($_POST['suppression'])){
    	if (isset($_POST['id'])){
    		//$username = $_POST['id'];
    		//$bdd->_suppression($username);
            $bdd->_suppression($_POST['id']);
    	}
    }

    if (isset($_POST['modifier'])){
    	if (isset($_POST['id'])){
            $username = $_POST['id'][0];
    		$bdd-> _modification($username);
    	}
    }

    if(isset($_POST['modifierInfo'])){
        if(isset($_POST['new_data'])){
            $new_data = $_POST['new_data'];
            if(isset($_SESSION['data'])){
                $data = $_SESSION['data'];
                if($data['email'] != $new_data[0] && isset($new_data[0])){
                    $data['email'] = $new_data[0];
                }else if($data['username'] != $new_data[1] && isset($new_data[1])){
                    $data['username'] = $new_data[1];
                }else if($data['pswd'] != $new_data[2] && isset($new_data[1])){
                    $data['pswd'] = $new_data[2];
                }
                $bdd->_trtModification($data);
            }            
        }
    }

    if(isset($_POST['unlog'])){
        $bdd->_deconnexion();
    }
    

    $title = "Login | AllForSport";

    include_once "./View/interface-admin.php";
?>