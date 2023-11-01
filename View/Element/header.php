<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////// HEADER ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Header of the application. Included at the start of every View.
?>
<header>
    <input type="checkbox" id="nav_check" hidden>
    <img src="View/_assets/image/MetaHubLogo.png" id="headerLogo"/>
    <nav>
        <ul>
            <li><a href="/"><img src="View/_assets/image/home.png" id="headerImg"/></a></li>
            <li><a href="../index.php" id="headerLinks">Posts</a></li>
            <li><a href="" id="headerLinks">Créer un Post</a></li>
            <li><a href="../index.php" id="headerLinks">Catégories</a></li>
        </ul>
    </nav>
    <a href='../index.php'>Se connecter</a>
    <label for="nav_check" aria-label="toggle curtain navigation" class="hamburger">
        <div class="line l1"></div>
        <div class="line l2"></div>
        <div class="line l3"></div>
    </label>
</header>
