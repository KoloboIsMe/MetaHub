<?php

namespace controls;

class Presenter
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function showHomePage()
    {
        $content = '';
        foreach ($this->outputData->getOutputData() as $post) {
            $id = $post->getTicket()->getTicket_ID();
            $content .= "
                <div class='card'>
                    <a href='posts&id=$id'>
                    <div class='card-content'>
                        <p>" . $post->getUser()->getUsername() . "</p>
                        <h3> " . $post->getTicket()->getTitle() . "</h3>
                        <p>" . $post->getTicket()->getMessage() . "</p>
                        <time>" . $post->getTicket()->getDate() . " </time>
                        <p>" . $post->getTicket()->getTicket_ID() . "</p>";

            foreach ($post->getCategories() as $category) {
                $content .= "<p>#" . $category->getLabel() . "</p>";
            }

            $content .= "
                    </div></a>
                </div>";
        }
        return $content;
    }

    public function showPosts()
    {
        $content = '';
        foreach ($this->outputData->getOutputData() as $post) {
            $id = $post->getTicket()->getTicket_ID();
            $content .= "
                <div class='card'>
                    <a href='posts&id=$id'>
                    <div class='card-content'>
                        <p>" . $post->getUser()->getUsername() . "</p>
                        <h3> " . $post->getTicket()->getTitle() . "</h3>
                        <p>" . $post->getTicket()->getMessage() . "</p>
                        <time>" . $post->getTicket()->getDate() . " </time>
                        <p>" . $post->getTicket()->getTicket_ID() . "</p>";

            foreach ($post->getCategories() as $category) {
                $content .= "<p>#" . $category->getLabel() . "</p>";
            }

            $content .= "
                    </div></a>
                </div>";
        }
        return $content;
    }

    public function showPost()
    {
        $content = '';
        $post = $this->outputData->getOutputData();
        $id = $post->getTicket()->getTicket_ID();
        $content .= "
            <div class='card'>
                <a href='posts&id=$id'>
                <div class='card-content'>
                    <p>" . $post->getUser()->getUsername() . "</p>
                    <h3> " . $post->getTicket()->getTitle() . "</h3>
                    <p>" . $post->getTicket()->getMessage() . "</p>
                    <time>" . $post->getTicket()->getDate() . " </time>
                    <p>" . $post->getTicket()->getTicket_ID() . "</p>";

                    foreach ($post->getCategories() as $category) {
                        $content .= "<p>#" . $category->getLabel() . "</p>";
                    }

                    foreach ($post->getComments() as $comment) {
                        $content .= "<p>" . $comment->getAuthor_username() . " : " . $comment->getText() . "</p>";
                    }

        $content .= "            
                </div></a>
            </div>";

        return $content;
    }

    public function showCategories()
    {
        $content = '';
        foreach ($this->outputData->getOutputData() as $category) {
            $id = $category->getCategory_ID();
            $content .= "
                <div class='card'>
                    <a href='categories&id=$id'>
                    <div class='card-content'>
                        <h3> " . $category->getLabel() . "</h3>
                        <p>" . $category->getDescription() . "</p>
                    </div></a>
                </div>";
        }
        return $content;
    }

    public function showCategorie($category){
        $content = '';
        $id = $category->getCategory_ID();
        $content .= "
                <div class='card'>
                    <a href='categories&id=$id'>
                    <div class='card-content'>
                        <h3>".$category->getLabel()."</h3>
                        <p>".$category->getDescription()."</p>";

                        foreach ($this->outputData->getOutputData() as $post) {
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

    public function showCreateTicket(){
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
                    foreach ($this->outputData->getOutputData() as $category) {
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
    }



}