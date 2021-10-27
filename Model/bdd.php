<?php

class Bdd
{
    private $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:dbname=bd_caf_1;host=127.0.0.1;charset=utf8", "root", "");
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            // Fonction connexion à la base de données si la connexion ne fonctionne pas 
            // On affiche : 'Connexion échouée'
        }
    }
}
?>