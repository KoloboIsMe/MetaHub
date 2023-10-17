<html lang="fr">
<head>
    <title>MetaHub - Register</title>

    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../_assets/styles/registerPage.css" media="screen" type="text/css" />
</head>
<body>
<div id="container">
    <!-- zone de connexion -->

    <form action="../Model/register.php" method="POST">
        <h1>Inscription</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <label><b>Confirmez le mot de passe</b></label>
        <input type="password" placeholder="Confimez le mot de passe" name="password" required>

        <label><b>admin ?</b></label>
        <select name="admin">
            <option value="0">non</option>
            <option value="1">oui</option>
        </select>

        <input type="submit" id='submit' value='REGISTER' >
    </form>
    Vous avez deja un compte ? <a href='login.php'>Se connecter</a>
</div>
</body>
</html>