<?php

namespace controls;

use entities\Category;
use entities\Post;

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
   $content .= "<h2>Fil d'actualité</h2>
                <div class='card-container1'>";

            for ($i = 0; $i < 5; $i++) {
                if ($this->outputData->getOutputData()[$i] instanceof Post) {
                    $post = $this->outputData->getOutputData()[$i];
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
                        for ($i = 0; $i < count($this->outputData->getOutputData()); $i++){
                            if ($this->outputData->getOutputData()[$i] instanceof Category) {
                                $category = $this->outputData->getOutputData()[$i];
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
                            <a href='editTicket&id=$id'><img src='gui/images/edit.png' id='editImg'></a>
                            <a href='/index.php?action=deleteTicketAction&id=$id'><img src='gui/images/delete.png' id='deleteImg'></a>
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
            <div class='card-content'>
                    <form action='".$_GET['url']."?action=createComment&id=$id' method='POST'>
                    <h3 id='comment'>Commentaires</h3>
                    <div class='input-box'>
                        <input type='text' class='input' placeholder='Ajoutez un commentaire' name='text'  required></input>
                    </div>
                    <input type='submit' class='btn' value='Ajouter'>
                    </form>
                </div>";

        foreach ($post->getComments() as $comment) {
            $content .= "<div class='comment'><img src='gui/images/user.png' id='user-comment-img'><div class='comment-content'>  @" . $comment->getAuthor_username() . " : " . $comment->getText() . "</div></div>";
        }

        $content .= "</div>";

        return $content;
    }

    public function showCategories()
    {
        $content = '';
        $content .= "<h2>Catégories</h2>";
    if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {
        $content .= "<a href='ouais'><button ><img src='gui/images/add.png' id='add-button'></button></a>";
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
                        <p id='category-description'>" . $category->getDescription() . "</p>
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
                                        <time id='time'>" . $post->getTicket()->getDate() . " </time>
                                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
                                    </div></a>
                                </div>";
        }
        $content .= "</div>";
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
        $title = $post->getTicket()->getTitle();
        return "
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action='/index.php?action=editTicketAction&id=$id' method='POST'>
                <h1>Edition</h1>
        
                <label><b>Titre</b></label>
                <input type='text' placeholder=\" Entrer le titre du post \" name='title' value=\"" . htmlspecialchars($title, ENT_QUOTES) . "\" required></input>
        
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
        $content .= "<h2>Utilisateurs</h2>";
        foreach ($this->outputData->getOutputData() as $user) {
            $id = $user->getUser_ID();
            $content .= "
                    <a href='users&id=$id'>
                    <div class='post-header'>
                        <img src='gui/images/user.png' id='usersImg'>
                        <p id='username-list'>@ " . $user->getUsername() . "</p>
                    </div>
                    </a>";
        }
        return $content;
    }

    public function showUser($user)
    {
        $content = '';
        $id = $user->getUser_ID();
        $content .= "
                    <a href='users&id=$id'>
                        <h2>@" . $user->getUsername() . "</h2>
                        <div class='card-container'>";

        foreach ($this->outputData->getOutputData() as $post) {
            $id = $post->getTicket()->getTicket_ID();
            $content .= "
                                <div class='post-card'>
                                    <a href='posts&id=$id'>
                                    <div class='card-content'>
                                        <h3> " . $post->getTicket()->getTitle() . "</h3>
                                        <p>" . $post->getTicket()->getMessage() . "</p>
                                        <time id='time'>" . $post->getTicket()->getDate() . " </time>
                                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
                                    </div></a>
                                </div>";
        }

        $content .= "</div>
                    </a>";
        return $content;
    }

}