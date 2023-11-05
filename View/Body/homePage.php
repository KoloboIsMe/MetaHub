<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////// HOME PAGE //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The home page of the application.
/// It is the first view called when arriving at the website.
if (!isset($cards))
{
    return;
}
?>

    <h1>Accueil</h1>
    <?php
    foreach ($cards as $card)
    {
        echo $card;
    }
    ?>

<?php
function showHomePage()
{
$content = '';
$content .= "<h2>Fil d'actualité</h2>
<div class='card-container1'>";

    for ($i = 0; $i < 5; $i++) {
    if ($outputData->getOutputData()[$i] instanceof Post) {
    $post = $outputData->getOutputData()[$i];
    $id = $post->getTicket()->getTicket_ID();
    $content .= "
    <div class='card'>
        <a href='posts&id=$id'>
            <div class='card-content'>
                <div class='post-header'>
                    <img src='gui/images/user.png' id='userImg'>
                    <p id='card-username'>@" . $post->getUser()->getUsername() . "</p>
                </div>
                <h3> " . $post->getTicket()->getTitle() . "</h3>
                <p>" . $post->getTicket()->getMessage() . "</p>
                <time id='time'><B>Publié le " . $post->getTicket()->getDate() . "</B> </time>
                <p id='post-number'>Post n° " . $post->getTicket()->getTicket_ID() . "</p>";

                if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['level']) && $_SESSION['user_ID'] == $post->getUser()->getUser_ID())) {
                $content .= "<div class='edit-delete'>
                    <a href='editTicket&id=$id'><img src='gui/images/edit.png' id='editImg'></a>
                    <a href='/index.php?action=deleteTicketAction&id=$id'><img src='gui/images/delete.png' id='deleteImg'></a>
                </div>";
                }
                $content .= " </div>
        </a>
    </div>";
    }
    }
    $content .= "
</div>
<div class='card-container2'>
    <div class='card2'>
        <div class='card-content'>
            <h3> Catégories</h3>
            <div class='category-list'>";
                for ($i = 0; $i < count($outputData->getOutputData()); $i++){
                if ($outputData->getOutputData()[$i] instanceof Category) {
                $category = $outputData->getOutputData()[$i];
                $id = $category->getCategory_ID();
                $content .= "<a href='categories&id=$id'><li><img src='gui/images/dot.png' class='dotImg'> #" . $category->getLabel() . "</li></a>";
                }
                }
                $content .="
            </div>
        </div>
    </div>
</div>
";

$content.="
<div class='card-container2'>
    <div class='card3'>
        <div class='card-content'>
            <h3> Suggestions</h3>
            <p>Lorem ipsum dolor sit amet. In perferendis voluptas id quam omnis id explicabo sequi.
                Qui deserunt voluptatem ea fuga illum ut vero sunt et quis laudantium est temporibus enim.
                33 ducimus commodi eum voluptatem dolores est saepe nobis ea voluptatem molestias est
                natus eveniet non iste placeat qui commodi nobis.</p>
        </div>
    </div>
</div>";
return $content;
}

