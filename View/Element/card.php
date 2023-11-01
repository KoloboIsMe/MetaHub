<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////// CARD ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The source code of a ticket.
/// ?>
<div class='card'>
    <a href='posts&id=<?php echo $post['id'] ?>'>
        <div class='card-content'>
            <p>" . <?php echo $post['username']?>. "</p>
            <h3> " . <?php echo $post['title'] ?>. "</h3>
            <p>" . <?php echo $post['message'] ?>. "</p>
            <time>" . <?php echo $post['date'] ?>. " </time>
            <p>" . <?php echo $post['id'] ?>. "</p>
            <?php
            foreach ($categories as $category)
            {
                echo "<p>#" . $category . "</p>";
            }
            foreach ($comments as $comment)
            {
                echo "<p>" . $comment->getAuthor_username() . " : " . $comment->getText() . "</p>";
            }
            ?>
        </div>
    </a>
</div>
