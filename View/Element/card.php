<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////// CARD ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The source code of a ticket.
/// ?>
<div class='card'>
    <a href='posts&id=<?php $post['id'] ?>'>
        <div class='card-content'>
            <p>" . <?php $post['username']?>. "</p>
            <h3> " . <?php $post['title'] ?>. "</h3>
            <p>" . <?php $post['message'] ?>. "</p>
            <time>" . <?php $post['date'] ?>. " </time>
            <p>" . <?php $post['id'] ?>. "</p>
        </div>
    </a>
</div>
