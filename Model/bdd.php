<?php

class Bdd
{   
    // Définition des variable de classe
    public $nom;
    public $prenom;
    public $mail;
    public $profil;
    private $login;
    private $pswd;
    public $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:dbname=bd_caf_1;host=127.0.0.1;charset=utf8", "root", "root");
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            // Fonction connexion à la base de données si la connexion ne fonctionne pas 
            // On affiche : 'Connexion échouée'
        }
    }

    public function _connexion($login, $pswd)
    {
        try {
            $req = 'SELECT login, empreinte, profile FROM bd_caf_1.utilisateur where login = :login and empreinte = :pswd';
            $res = $this->dbh->prepare($req);
            $res->execute([":login" => $login, ":pswd" => $pswd]);
            $lignes = $res->fetchAll();
            $userexist = count($lignes);
            if ($userexist == 1) {
                $_SESSION['connect'] = true;
                for($i = 0; $i < count($lignes); $i++){
                    $_SESSION['profil'] = $lignes[$i]['profile'];
                }
                if($_SESSION['profil'] == 'admin'){
                    header('Location: ../Controller/interface-admin.php');
                    exit;
                }else {
                    header('Location: ../Controller/index.php');
                    exit;
                }
                
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
?>