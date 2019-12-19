<?php include("conexion.php");?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>conixion</title>
</head>

<body>
    <header>
        <div><img src="logo.png" alt="logo"></div>
        <form action="" method="POST" id="conexion">
            <p><label for="pseudo">pseudo: </label><input type="text" name="pseudo" id="pseudo" placeholder="pseudo" required></p>
            <p><label for="mdp">Mot de passe: </label><input type="password" name="mdp" id="mdp" placeholder="mot de passe" required></p>
            <p><input type="submit" id="BConexion" name="BConexion" value="conexion"></p>
        </form>
    </header>
    <section>
        <h1>SI VOUS N'ETES PAS INSCRIT INSCRIVEZ-VOUS</h1>
        <form action="" method="POST" id="inscription" enctype="multipart/form-data">
            <fieldset id="A">
                <legend>Identifiant</legend>
                <p><label for="prePseudo">Pseudo: </label><input type="text" name="prePseudo" id="prePseudo" placeholder="entrer le pseudo ..."></p>
                <p><label for="preMdp">Mot de passe: </label><input type="password" name="preMdp" id="preMdp" placeholder="entrerle mot de passe ..."></p>
            </fieldset>
            <fieldset id="B">
                <legend>Données Personel</legend>
                <p><label for="nom">Nom: </label><input type="text" name="nom" id="nom" placeholder="Entrer votre nom ..."></p>
                <p><label for="prenom">prénom: </label><input type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom ..."></p>
                <p><label for="email">Email: </label><input type="email" name="email" id="email" placeholder="Entrer votre mail ..."></p>
                <p><label for="photo">Photo: </label> <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg"></p>
            </fieldset>
            <input type="submit" value="Valider" name="BSubmit" id="BSubmit">
        </form>
    </section>
</body>

</html>