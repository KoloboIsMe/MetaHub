<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $t ?></title>
    <link  rel="stylesheet" href="<?= SCRIPTS . 'css' .DIRECTORY_SEPARATOR . 'header.css' ?>"  />
    <link rel="shortcut icon" type="image/png" href="MetaHubLogo.png"/>
</head>
<body>
<header>
    <input type="checkbox" id="nav_check" hidden>
    <img src="/gui/images/MetaHubLogo.png" id="headerLogo"/>
    <nav>
        <ul>
            <li><a href="/metahub"><img src="/gui/images/home.png" id="headerImg"/></a></li>
            <li><a href="/metahub/posts" id="headerLinks">Posts</a></li>
            <li><a href="" id="headerLinks">Créer un Post</a></li>
            <li><a href="" id="headerLinks">Catégories</a></li>
        </ul>
    </nav>
    <img src="/gui/images/login.png" id="headerImg"/>
    <label for="nav_check" aria-label="toggle curtain navigation" class="hamburger">
        <div class="line l1"></div>
        <div class="line l2"></div>
        <div class="line l3"></div>
    </label>
</header>
<script src="/gui/script.js"></script>

<?= $content ?>

<link href="<?= SCRIPTS . 'css' .DIRECTORY_SEPARATOR . 'app.css' ?>" rel="stylesheet" type="text/css" />
<footer>
    <div class="footerImages">
        <img src="/gui/images/instagram.png" id="footerImg">
        <img src="/gui/images/snapchat.png" id="footerImg">
        <img src="/gui/images/twitter.png" id="footerImg">
        <img src="/gui/images/facebook.png" id="footerImg">
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
