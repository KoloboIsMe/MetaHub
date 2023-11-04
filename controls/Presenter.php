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
        $content .= "<h2>Fil d'actualité</h2>";
        $content .= "<div class='card-container1'>";

        foreach ($this->outputData->getOutputData() as $post) {
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

            if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['level']) && $_SESSION['user_ID'] == $post->getUser()->getUser_ID())){
            $content .= "<div class='edit-delete'>
                            <a href='editTicket&id=$id'><img src='gui/images/edit.png' id='editImg'></a>
                            <a href='/index.php?action=deleteTicketAction&id=$id'><img src='gui/images/delete.png' id='deleteImg'></a>
                        </div>";
            }

        $content .= "</div></a>
                </div>";
        }
        $content .= "
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
        return $content;

    }

    public function showPosts()
    {
        $content = '';
        $content .= "<h2>Posts</h2>
                     <div class='card-container'>";
        foreach ($this->outputData->getOutputData() as $post) {
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
                        <time id='time'><B>Publié le " . $post->getTicket()->getDate() . "</B> </time>
                        <p id='post-number'>Post n° " . $post->getTicket()->getTicket_ID() . "</p>";

            if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['level']) && $_SESSION['user_ID'] == $post->getUser()->getUser_ID())){
                $content .= "<div class='edit-delete'>
                            <a href='".$_GET['url']."?action=editTicket&id=$id'><img src='gui/images/edit.png' id='editImg'></a>
                            <a href='".$_GET['url']."?action=deleteTicketAction&id=$id'><img src='gui/images/delete.png' id='deleteImg'></a>
                        </div>";
            }

        $content .="</div></a>
                </div>
                ";
        }
        $content .= "</div>";
        return $content;
    }

    public function showPost()
    {
        $content = '';
        $content .= "<h2>Post</h2>
                      ";
        $post = $this->outputData->getOutputData();
        $id = $post->getTicket()->getTicket_ID();
        $content .= "<div class='card-container1'>
                            ";
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

        foreach ($post->getCategories() as $category) {
            $content .= "<p id='category'>#" . $category->getLabel() . "</p>";
        }

        $content .= "            
                </div>
                </a>
            </div>
            <div class='comment-card'>
            ";

        foreach ($post->getComments() as $comment) {
            $content .= "<p>@" . $comment->getAuthor_username() . " : " . $comment->getText() . "</p>";
        }

        $content .= "
                <div class='card-content'>
                    <form action='".$_GET['url']."?action=createComment&id=$id' method='POST'>
                    <h3 id='comment'>Commentaires</h3>
                    <div class='input-box'>
                        <input type='text' class='input' placeholder='Ajoutez un commentaire' name='text'  required></input>
                    </div>
                    <input type='submit' class='btn' value='Ajouter'>
                    </form>
                </div>
            </div>";

        return $content;
    }

    public function showCategories()
    {
        $content = '';
        $content .= "<h2>Catégories</h2>";
    if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {
        $content .= "<a href='ouais'><button >Créer une categorie</button></a>";
    }
        $content .= "<div class='card-container'>";
        foreach ($this->outputData->getOutputData() as $category) {
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

    public function showCategory($category)
    {
        $content = '';
        $id = $category->getCategory_ID();
        $content .= "
                        <h2>#" . $category->getLabel() . "</h2>
                        <p id='category-description'>" . $category->getDescription() . "</p>";

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

    public function showCreateTicket()
    {
        $content = "
        <script src='https://unpkg.com/slim-select@latest/dist/slimselect.min.js'></script>
        <link href='gui/css/CategorySelectionBar.css' rel='stylesheet'></link>
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action='/".$_GET['url']."?action=createPostsAction' method='POST'>
                <h1>Nouveau Post</h1>
        
                <label><b>Titre</b></label>
                <input type='text' placeholder=\" Entrer le titre du post \" name='title' required>
        
                <label><b>Contenu du post</b></label>
                <textarea placeholder='Entrer le contenu du post' name='message' required></textarea>
        
                <select id='category' multiple name='categories[]'>";
        foreach ($this->outputData->getOutputData() as $category) {
            $content .= "<option>" . $category->getLabel() . "</option>";
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

    public function showEditTicket()
    {
        $post = $this->outputData->getOutputData();
        $id = $post->getTicket()->getTicket_ID();
        return "
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action='/index.php?action=editTicketAction&id=$id' method='POST'>
                <h1>Edition</h1>
        
                <label><b>Titre</b></label>
                <input type='text' placeholder=\" Entrer le titre du post \" name='title' value='" . $post->getTicket()->getTitle() . "' required>
        
                <label><b>Contenu du post</b></label>
                <textarea placeholder='Entrer le contenu du post' name='message' required>" . $post->getTicket()->getMessage() . "</textarea>
        
                <input type='submit' id='submit' value='Enregistrer' >
            </form>
        </div>
        ";

    }

    public function showUsers()
    {
        $content = '';
        foreach ($this->outputData->getOutputData() as $user) {
            $id = $user->getUser_ID();
            $content .= "
                <div class='card'>
                    <a href='users&id=$id'>
                    <div class='card-content'>
                        <h3> " . $user->getUsername() . "</h3>
                    </div></a>
                </div>";
        }
        return $content;
    }

    public function showUser($user)
    {
        $content = '';
        $id = $user->getUser_ID();
        $content .= "
                <div class='card'>
                    <a href='users&id=$id'>
                    <div class='card-content'>
                        <h3>" . $user->getUsername() . "</h3>";

        foreach ($this->outputData->getOutputData() as $post) {
            $id = $post->getTicket()->getTicket_ID();
            $content .= "
                                <div class='card'>
                                    <a href='posts&id=$id'>
                                    <div class='card-content'>
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

}