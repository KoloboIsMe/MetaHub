<?php
if (!isset($title, $logged))
{
    return;
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <?php if($logged === FALSE) echo '
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">';
            ?>
            <meta charset="UTF-8">
            <title><?php echo $title ?></title>
            <link href="View/_assets/style/layout.css" rel="stylesheet" type="text/css"/>
            <link href="View/_assets/image/MetaHubLogo.png" rel="shortcut icon" type="image/png"/>
        </head>
        <script src="gui/js/script.js"></script>
