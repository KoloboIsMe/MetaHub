<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  MAIN  ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The main controler of the app.
/// It redirects to the correct controller.

// If action is to log in, call login.php
if(isset($_POST['action']) && $_POST['action'] === 'login')
{
    require 'login.php';
}

if (!empty($_GET['url']))
{
    $page = $_GET['url'];
}
else
{
    // TODO : CHECK IF USER HAS A SESSION
    $page = 'homepage';

}

require 'display.php';

return;