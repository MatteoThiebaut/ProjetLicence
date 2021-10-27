<?php

class User
{
    // Définition des variable de classe
    public $nom;
    public $prenom;
    public $mail;
    public $profil;
    private $login;
    private $pswd;
    
    public function __construct()
    {
        $bdd = new Bdd();
    }
    
    public function _connexion($login, $pswd)
    {
        try {
            $bdd = new Bdd();
            $req = 'SELECT login, empreinte FROM bd_caf_1.utilisateur where login = :login and empreinte = :pswd';
            $res = $this->$bdd->prepare($req);
            $res->execute([":login" => $login, ":pswd" => $pswd]);
            $userexist = $res->rowCount();
            if ($userexist == 1) {
                $_SESSION['connect'] = true;
                header('Location: ./Controller/index.php');
                exit;
            } else {
                echo '<span style="color: red;">Erreur: Identifiant ou mot de passe non valide.</span>';
                // Fonction de connexion avec identifiant et mot de passe en comparant avec la base de données.
                // Si l'identifiant est incorrecte on affiche : 'Erreur: Identifiant ou mot de passe non valide.'
            }
        }catch(PDOException $error) {
            echo $error->getMessage();
            exit(1);
        }
    }
}