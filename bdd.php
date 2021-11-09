<?php

class Bdd
{   
    // Définition des variable de classe
    public $nom;
    public $prenom;
    public $email;
    public $profil;
    private $login;
    private $pswd;
    public $dbh;
    public $pok;

    // Connexion à la base de données :
    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:dbname=bd_caf_2;host=127.0.0.1;charset=utf8", "uti_quizz", "admin");
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            // Fonction connexion à la base de données si la connexion ne fonctionne pas 
            // On affiche : 'Connexion échouée'
        }
    }
    // Connexion de l'utilisateur : comparaison de ses informations rentrées avec ceux présents dans la BDD
    public function _connexion($login, $pswd)
    {
        try {
            $login=$this->validationDonnees($login);
            $pswd=$this->validationDonnees($pswd);
            $pswd = crypt($pswd,'ru');
            $req = 'SELECT * FROM bd_caf_2.utilisateur where login = :login and empreinte = :pswd';
            $res = $this->dbh->prepare($req);
            $res->execute([":login" => $login, ":pswd" => $pswd]);
            $lignes = $res->fetchAll();
            if (count($lignes) == 1) {  // S'il existe au moins une lignes correspondant aux critères alors les données sont valides
                $_SESSION['connect'] = true;
                for($i = 0; $i < count($lignes); $i++){
                    $_SESSION['profil'] = $lignes[$i]['profil'];
                    $_SESSION['id'] = $lignes[$i]['id'];
                    $_SESSION['user'] = $lignes[$i]['login'];
                }
                if($_SESSION['profil'] == 'admin'){
                    header('Location: ./interface-admin.php');
                    exit;
                }else {
                    header('Location: ./index.php');
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

    /* Fonctionnalitées administrateur : */

    // Insertion d'un nouvel utilisateur depuis l'interface admin :
    public function _inscription($username, $profil, $pswd, $email)
    {
        try {
            $username=$this->validationDonnees($username);
            $email=$this->validationDonnees($email);
            $profil=$this->validationDonnees($profil);
            $pswd=$this->validationDonnees($pswd);
            $pswd = crypt($pswd,'ru');
            // Pour définir l'ID récupéraction de toutes les lignes de la table utilisateur, son nombre + 1 donnera l'ID de l'user nouvellement créée
            $req = 'SELECT * FROM bd_caf_2.utilisateur';
            $res = $this->dbh->prepare($req);
            $res->execute();
            $lignes = $res->fetchAll();
            //$lignes = count($lignes) + 1;
            // Insertion des données fournits dans la table utilisateur
            $req = 'insert into utilisateur (login, profil, empreinte, email) values (:username,:profil,:pswd,:email)';
            $res = $this->dbh->prepare($req);
            //$res->bindParam(':id', $lignes);
            $res->bindParam(':username', $username);
            $res->bindParam(':profil', $profil);
            $res->bindParam(':pswd', $pswd);
            $res->bindParam(':email', $email);
            $res->execute();
        }catch(PDOException $error) {
            echo $error->getMessage();
            exit(1);
        }
    }
    
    // Affichage des utilisateur depuis l'interface admin :
    public function _affichage($arg){
        try {
            $req = 'SELECT * FROM bd_caf_2.utilisateur where profil = :profil';
            $res = $this->dbh->prepare($req);
            $res->execute([":profil" => $arg]);
            $lignes = $res->fetchAll();
            echo "<table>";
                echo "<tr>";
                    echo "<th></th>";
                    echo "<th>Nom d'utilisateur</th>";
                    echo "<th>Profile</th>";
                    echo "<th>Adresse e-mail</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<form action='' method='post'>";
                    foreach($lignes as $key => $value){
                        $id = $lignes[$key]['id'];
                        echo "<th><input type=checkbox name=id[] value='$id'></th>";
                        echo "<th>".$lignes[$key]['login']."</th>";
                        echo "<th>".$lignes[$key]['profil']."</th>";
                        echo "<th>".$lignes[$key]['email']."</th>";
                        echo "</tr>";
                    }
                
            echo "</table>";
            echo "<input class=suppression type=submit name=suppression value=Supprimer>";
            echo "<input class=modifier type=submit name=modifier value=Modifier>";
            echo "</form>";
        }catch(PDOException $error) {
            echo $error->getMessage();
            exit(1);
        }
    }

    // Modification d'un utilisateur depuis l'interface admin :
    public function _modification($arg)
    {
        try {

            $req = 'SELECT id,login, email, empreinte, profil FROM bd_caf_2.utilisateur where id = :id';
            $res = $this->dbh->prepare($req);
            $res->execute([":id" => $arg]);
            $lignes = $res->fetch();

            $data = array(
                
                'id' => $lignes['id'],
                'email' => $lignes['email'], 
                'username' => $lignes['login'],
                'pswd' => $lignes['empreinte'],

            );

            $_SESSION['data'] = $data;


            // formulaire qui va entrer les nouvelles informations dans le tableau data
            echo "<form action='' method='post'>";
                echo $lignes['email'].": <input class='inputenter' type='text' name='new_data[]' placeholder='Adresse e-mail'/><br>";
                echo $lignes['login'].": <input class='inputenter' type='text' name='new_data[]' placeholder='identifiant'/><br>";
                echo "<input class='inputenter' type='password' name='new_data[]' placeholder='Mot de passe'/><br>";
                echo "<input class='modifierInfo' type='submit' name='modifierInfo' value='Modifier'>";
            echo "</form>";
            
        }catch(PDOException $error) {
            echo $error->getMessage();
            exit(1);
        }
    }

    public function _trtModification($data){
        try {

            $req = "update bd_caf_2.utilisateur set email = :new_email, empreinte = :pswd, login = :login where id = :id";
            $res = $this->dbh->prepare($req);
            $res->execute([':new_email' => $data['email'],':pswd' => $data['pswd'], ':login' => $data['username'], ':id' => $data['id']]);

        }catch(PDOException $error) {
            echo $error->getMessage();
            exit(1);
        }
    }

    // Supression d'utilisateur depuis l'interface admin :
    public function _suppression($arg)
    {
        try {
            $req = 'delete FROM bd_caf_2.utilisateur where id = :id';
            $res = $this->dbh->prepare($req);
            for($i = 0; $i < count($arg); $i++){

                $res->execute([":id" => $arg[$i]]);

            }
        }catch(PDOException $error) {
            echo $error->getMessage();
            exit(1);
        }
    }

    // Deconnexion de toutes session existante
    public function _deconnexion(){
        session_destroy();
        header("Location: ./index.php");
        exit;
    }

    // vérification de la validité des données 
    public function validationDonnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

}

?>