<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $t ?></title>
    <link href="_assets/styles/header.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/png" href="/_assets/images/MetaHubLogo.png"/>
</head>
<body>
<header>
    <input type="checkbox" id="nav_check" hidden>
    <img src="/_assets/images/MetaHubLogo.png" id="headerLogo"/>
    <nav>
        <ul>
            <li><a href="index.php"><img src="/_assets/images/home.png" id="headerImg"/></a></li>
            <li><a href="" id="headerLinks">Posts</a></li>
            <li><a href="" id="headerLinks">Créer un Post</a></li>
            <li><a href="" id="headerLinks">Catégories</a></li>
        </ul>
    </nav>
    <img src="/_assets/images/login.png" id="headerImg"/>
    <label for="nav_check" aria-label="toggle curtain navigation" class="hamburger">
        <div class="line l1"></div>
        <div class="line l2"></div>
        <div class="line l3"></div>
    </label>
</header>
<script src="/views/script.js"></script>

<?= $content ?>

<link href="_assets/styles/footer.css" rel="stylesheet" type="text/css" />
<footer>
    <div class="footerImages">
        <img src="/_assets/images/instagram.png" id="footerImg">
        <img src="/_assets/images/snapchat.png" id="footerImg">
        <img src="/_assets/images/twitter.png" id="footerImg">
        <img src="/_assets/images/facebook.png" id="footerImg">
    </div>
    <div class="footerContact">
        <p>Contactez-nous :</p><br>
        <p>Email : contact@exemple.com</p><br>
        <p>Téléphone : +33 123 456 789</p><br>
    </div>
    <div class="footerCopyright">
        © 2023 MetaHub. Tous droits réservés.
    </div>
</footer>
