<?php
foreach ($params['tickets'] as $post): ?>
    <article>
        <header>
            <a href="<?= "posts/" . $post->getTicket_Id() ?>">
                <h1 class="titreBillet"><?= $post->getTitle() ?></h1>
            </a>
            <time><?= $post->getDate() ?></time>
        </header>
        <p><?= $post->getMessage() ?></p>
    </article>
    <hr />
<?php endforeach; ?>
