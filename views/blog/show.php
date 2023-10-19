<article>
    <header>
        <a href="<?= $params['ticket'][0]->getTicket_Id() ?>">
            <h1 class="titreBillet"><?= $params['ticket'][0]->getTitle() ?></h1>
        </a>
        <time><?= $params['ticket'][0]->getDate() ?></time>
    </header>
    <p><?= $params['ticket'][0]->getMessage() ?></p>
</article>
<hr />
