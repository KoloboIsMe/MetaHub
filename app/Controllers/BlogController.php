<?php

namespace App\Controllers;

use Database\DBConnection;

class BlogController extends Controller
{
    public function welcome(){
        return $this->view('blog.welcome');
    }

    public function index(){
        return $this->view('blog.index');
    }
    public function show(int $id){
        $db = DBConnection::getInstance();
        $req = $db->getPDO()->query('SELECT * FROM tickets');
        $tickets = $req->fetchAll();
        return $this->view('blog.show', compact('id'));
    }
}