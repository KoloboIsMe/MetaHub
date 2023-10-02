<?php
    function start_page($title): void
    {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
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
        <script src="/View/script.js"></script>
<?php
}
?>