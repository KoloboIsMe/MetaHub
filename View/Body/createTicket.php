<?php
$content = "
<script src='https://unpkg.com/slim-select@latest/dist/slimselect.min.js'></script>
<link href='gui/css/CategorySelectionBar.css' rel='stylesheet'></link>
<link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
<div id='container'>
    <form action=createPostsAction method='POST'>
        <h1>Nouveau Post</h1>

        <label><b>Titre</b></label>
        <input type='text' placeholder=\" Entrer le titre du post \" name='title' required>

        <label><b>Contenu du post</b></label>
        <textarea placeholder='Entrer le contenu du post' name='message' required></textarea>

        <select id='category' multiple name='categories[]'>";
            foreach ($outputData->getOutputData() as $category) {
            $content .= "<option>".$category->getLabel()."</option>";
            }
            $content .= "
        </select>
        <input type='submit' id='submit' value='Publier' >
    </form>
</div>

<script>
    new SlimSelect({
        select: '#category',
        settings: {
            placeholderText: 'Choisir une catégorie',
            searchPlaceholder: 'Rechercher',
        }
    })
</script>
";

return $content;
?>