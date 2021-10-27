<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface administrateur</title>
</head>
<body>
    <main>
        <article>
            <h4>Inscrire un utilisateur :</h4>
            <form action="function/function-user.php?action=1" method="POST">
                <label for="profil">Profile utilisateur :</label>
                <select name="profil" id="profil">
                    <option value="enseignant">Enseignant</option>
                    <option value="eleve">Élève</option>
                </select>
                <label for="email">Adresse e-mail :</label><input autocomplete="on" type="text" name="email" required pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})">
                <label for="username">Nom d'utilisateur :</label><input type="text" name="username" required maxlength="10" pattern="^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){4,18}[a-zA-Z0-9]$">
                <label for="pswd">Mot de passe :</label><input type="text" name="pswd" required>
                <input type="submit" value="Inscription">
            </form>
        </article>
        <article>
            <h4>Enseigant :</h4>
        </article>
        <article>
            <h4>Élève :</h4>
        </article>
    </main>
</body>
</html>