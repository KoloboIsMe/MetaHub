<?php
if (!isset($id, $label, $description))
{
    return;
}
?>
<div class='card'>
    <a href='categories&id=<?php $id ?>'>
        <div class='card-content'>
            <h3> <?php $label ?> </h3>
            <p> <?php $description ?></p>
        </div></a>
</div>