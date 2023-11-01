<?php

require __DIR__ . '/../Model/fivePosts.php';

foreach ($posts as $post)
{
    require __DIR__ . '/../View/Element/card.php';
}
