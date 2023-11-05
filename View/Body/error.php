<?php
if (!isset($error))
{
    $error = 'Erreur inconnue';
}
?>
<link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
<h1 class='titreErreur'>
    <?php echo $error ?>
</h1>
