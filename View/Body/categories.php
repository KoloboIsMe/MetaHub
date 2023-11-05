<?php
function showCategorie($category){
$content = '';
$id = $category->getCategory_ID();
$content .= "
<div class='card'>
    <a href='categories&id=$id'>
        <div class='card-content'>
            <h3>".$category->getLabel()."</h3>
            <p>".$category->getDescription()."</p>";

            foreach ($outputData->getOutputData() as $post) {
            $id = $post->getTicket()->getTicket_ID();
            $content .= "
            <div class='card'>
                <a href='posts&id=$id'>
                    <div class='card-content'>
                        <p>" . $post->getUser()->getUsername() . "</p>
                        <h3> " . $post->getTicket()->getTitle() . "</h3>
                        <p>" . $post->getTicket()->getMessage() . "</p>
                        <time>" . $post->getTicket()->getDate() . " </time>
                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
                    </div></a>
            </div>";
            }

            $content .= "
        </div></a>
</div>";
return $content;
}
?>
