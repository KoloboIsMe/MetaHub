<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  MAIN  ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The main controler of the app.
/// It redirects to the correct controller.


if (empty($_GET['url']))
{
    $page = 'homepage';
}
else
{
    $page = $_GET['page'];
}

require 'display.php';

return;