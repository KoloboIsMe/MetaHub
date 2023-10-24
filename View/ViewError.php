<?php

namespace gui;

class ViewError extends View
{
    public function __construct($layout, $error, $redirect)
    {
        parent::__construct($layout);

        header("refresh:1;url=$redirect");

        $this->title = 'Erreur';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = '
                        <div class="home" id="home">
                            <div class="error-message">
                                <h3>' . $error . '</h3>
                            </div>
                        </div>';
    }
}