<?php

require __DIR__ . '/../Model/fivePosts.php';

foreach ($posts as $post)
{
    $categories = "<p>#" . $category->getLabel() . "</p>";
    $comments = "<p>" . $comment->getAuthor_username() . " : " . $comment->getText() . "</p>";
    foreach ($post->getCategories() as $category) {
        $content .= "<p>#" . $category->getLabel() . "</p>";
    }

    foreach ($post->getComments() as $comment) {
        $content .= "<p>" . $comment->getAuthor_username() . " : " . $comment->getText() . "</p>";
    }

    require __DIR__ . '/../View/Element/card.php';
}

require __DIR__ . '/../View/Body/homePage.php';

return;