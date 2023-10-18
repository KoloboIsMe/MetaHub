<?php

class view
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';
    }

    public function generate($data)
    {
        // Génération de la partie spécifique de la vue
        $content = $this->generateFile($this->_file, $data);
        // Ajout Template
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));
        // Renvoi de la vue au navigateur
        echo $view;
    }

    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $file;
            return ob_get_clean();
        }
        else {
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
}