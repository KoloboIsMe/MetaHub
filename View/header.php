<?php
    function start_page($title): void
    {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link href="_assets/styles/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <input type="checkbox" id="nav_check" hidden>
            <nav>
                <ul>
                    <li class="active"><a <img src="/_assets/images/home.png"/> href="index.html" class="active"></a></li>
                    <li><a href="">Posts</a></li>
                    <li><a href="">Créer un Post</a></li>
                    <li><a href="">Catégories</a></li>
                    <li><a <img src="/_assets/images/login.png"> href="" </a></li>
                </ul>
            </nav>
            <label for="nav_check" aria-label="toggle curtain navigation" class="hamburger">
                <div class="line l1"></div>
                <div class="line l2"></div>
                <div class="line l3"></div>
            </label>
        </header>
<?php
}
?>