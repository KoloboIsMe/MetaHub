<?php

namespace gui;

class ViewError extends View
{
    public function __construct($layout, $error, $redirect = null)
    {
        parent::__construct($layout);

        if ($redirect != null)
            header("refresh:1;url=$redirect");

        $this->title = 'Erreur';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = "
                        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
                        <h1 class='titreErreur'>" . $error . "</h1>
                        ";
    }
}