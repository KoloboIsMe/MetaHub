<?php

use Controler\Element\Card;

require __DIR__ . '/../../Model/fivePosts.php';

if(!isset($tickets, $categories, $comments))
{
    return;
}

foreach ($tickets->getData() as $ticket)
{
    $cards[] = new Card($ticket, $categories, $comments);
}



require __DIR__ . '/../../View/Body/homePage.php';

return;