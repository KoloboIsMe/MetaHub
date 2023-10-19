<?php

namespace App\Controllers;
class Controller
{
    public function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if($params){
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

//    public function connexionViews(){
//        ob_start();
//        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
//        $t = explode(DIRECTORY_SEPARATOR, $path)[1];
//        require VIEWS . $path . '.php';
//        if($params){
//            $params = extract($params);
//        }
//        $content = ob_get_clean();
//        require VIEWS . 'templateConnexion.php';
//    }

}