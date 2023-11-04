<?php

require __DIR__ . '/../Model/fivePosts.php';

foreach ($posts as $post)
{
    $cards[] = new Card($post['username'],
                        $post['title'],
                        $post['message'],
                        $post['message'],
                        $post['date'],
                        $post['id'],
                        $categories,
                        $comments);
}

require __DIR__ . '/../View/Body/homePage.php';

return;