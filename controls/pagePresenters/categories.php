<h2>Catégories</h2>
<?php if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {?>
    <a href='ouais'><button ><img src='gui/images/add.png' id='add-button'></button></a>
<?php }?>
<div class='card-container'>
    <?php foreach ($data as $category) {
    $id = $category->getCategory_ID(); ?>
    <div class='category-card'>
        <a href='categories&id=<?=$id?>'>
        <div class='card-content'>
            <h3> #<?= $category->getLabel() ?></h3>
            <p><?= $category->getDescription() ?></p>
            <div class="edit-delete">
                <?php if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {?>
                    <a href='ouais'><button ><img src='gui/images/delete.png' id='deleteImg'></button></a>
                <?php }?>
            </div>
        </div>
        </a>
    </div>
    <?php }?>
</div>

