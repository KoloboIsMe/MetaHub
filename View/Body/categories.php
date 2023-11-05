<?php
function showCategories()
{
    $content = '';
    $content .= "<h2>Catégories</h2>";
    if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {
        $content .= "<a href='ouais'><button ><img src='gui/images/add.png' id='add-button'></button></a>";
    }
    $content .= "<div class='card-container'>";
    foreach ($outputData->getOutputData() as $category) {
        $id = $category->getCategory_ID();
        $content .= "
                <div class='category-card'>
                    <a href='categories&id=$id'>
                    <div class='card-content'>
                        <h3> #" . $category->getLabel() . "</h3>
                        <p>" . $category->getDescription() . "</p>
                    </div></a>
                </div>";
    }
    $content .= "</div>";
    return $content;
}
function showCategory($category)
{
    $content = '';
    $id = $category->getCategory_ID();
    $content .= "
                        <h2>#" . $category->getLabel() . "</h2>
                        <p id='category-description'>" . $category->getDescription() . "</p>
                        <div class='card-container'>";

    foreach ($outputData->getOutputData() as $post) {
        $id = $post->getTicket()->getTicket_ID();
        $content .= "
                                <div class='post-card'>
                                    <a href='posts&id=$id'>
                                    <div class='card-content'>
                                        <div class='post-header'>
                                            <img src='gui/images/user.png' id='userImg'>
                                            <p id='card-username'>@" . $post->getUser()->getUsername() . "</p>
                                        </div>
                                        <h3> " . $post->getTicket()->getTitle() . "</h3>
                                        <p>" . $post->getTicket()->getMessage() . "</p>
                                        <time id='time'>" . $post->getTicket()->getDate() . " </time>
                                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
                                    </div></a>
                                </div>";
    }
    $content .= "</div>";
    return $content;
}
?>
