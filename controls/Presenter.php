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
                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
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
                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
                    </div></a>
                </div>
                <div class='card-container2'>
                <div class='card2'>
                    <div class='card-content'>
                        <h3> Catégories</h3>
                        <div class='dot-container'>
                            <div class='dot d1'></div>
                            <div class='dot d2'></div>
                            <div class='dot d3'></div>
                            <div class='dot d4'></div>
                            <div class='dot d5'></div>
                        </div>
                        <div class='category-list'>
                            <ul>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Lorem ipsum dolor sit amet</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        
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