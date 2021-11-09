<<<<<<< Updated upstream
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./View/css/interface-admin.css">
</head>
<body>
    <nav><form action="" method="post"><input type="submit" value="Déconnexion" name="unlog"></form></nav>
    <main>
        <article>
            <h4>Inscrire un utilisateur :</h4>
            <form action="" method="post">
                <br>
                <label for="profil">Profil de l'utilisateur :</label><br>
                <select name="profil" id="profil">
                    <option value="enseignant">Enseignant</option>
                    <option value="eleve">Élèves</option>
                </select><br>
                <input class="inputenter" type="text" name="email" placeholder="Adresse e-mail" /><br>
                <input class="inputenter" type="text" name="identifiant" placeholder="Identifiant" /><br>
                <input class="inputenter" type="password" name="password" placeholder="Mot de passe" /><br>
                <input class="inscription" type="submit" name="inscription" value="Inscrire">
            </form>
        </article>
        <article>
            <h4>Élèves</h4>
            <?php $arg = 'eleve';$bdd->_affichage($arg); ?>
        </article>
        <article>
            <h4>Enseignant</h4>
            <?php $arg = 'enseignant';$bdd->_affichage($arg); ?>
        </article>
    </main>
</body>
</html>
=======
<?php
session_start();
include_once "./Controller/interface-admin.php";
?>
>>>>>>> Stashed changes
