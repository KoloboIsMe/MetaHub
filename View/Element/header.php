<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////// HEADER ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Header of the application. Included at the start of every View.
if (!isset($logged, $admin))
{
    $logged = FALSE;
    $admin = FALSE;
}
if($logged && empty($username))
{
    return;
}
?>
<body>
    <header>
        <input hidden id="nav_check" type="checkbox">
        <img id="headerLogo" src="View/_assets/image/MetaHubLogo.png"/>
        <nav>
            <ul>
                <?php if($logged || $admin) echo "
                <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
                <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
                <link href=\"https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap\" rel=\"stylesheet\">"
                ?>
                <li><a href="/"><img id="headerImg" src="View/_assets/image/home.png"/></a></li>
                <li><a href="posts" id="headerLinks">Posts</a></li>
                <li><a href="createPosts" id="headerLinks">Créer un Post</a></li>
                <li><a href="categories" id="headerLinks">Catégories</a></li>
                <li><a href="users" id="headerLinks">Utilisateurs</a></li>
                <?php if($admin) echo "
                <li><a href=\"admin\" id=\"headerLinks\">Administration</a></li>"
                ?>
            </ul>
        </nav>
        <?php if($logged || $admin) { echo "
        <a href='/logout' id=\"username\">Bonjour @$username !</a>
        <a href='/logout'><img src=\"View/_assets/images/logout.png\" id=\"logoutImg\"/></a>";}
        else {echo "
        <a href='/login'><img src=\"View/_assets/images/login.png\" id=\"loginImg\"/></a>";}
        ?>
        <label aria-label="toggle curtain navigation" class="hamburger" for="nav_check">
            <div class="line l1"></div>
            <div class="line l2"></div>
            <div class="line l3"></div>
         </label>
    </header>
