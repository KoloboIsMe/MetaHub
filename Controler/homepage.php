<?php

use Controler\Element\Card;

require __DIR__ . '/../Model/fivePosts.php';

if(!isset($tickets))
{
    return;
}

foreach ($tickets->getData() as $ticket)
{
    $cards[] = new Card($ticket);
}



require __DIR__ . '/../View/Body/homePage.php';

return;