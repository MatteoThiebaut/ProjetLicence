<?php

class Bdd
{
    public $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:host=localhost;dbname=bd_caf_1", 'root','root');
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            // Fonction connexion à la base de données si la connexion ne fonctionne pas 
            // On affiche : 'Connexion échouée'
        }
    }

}
?>