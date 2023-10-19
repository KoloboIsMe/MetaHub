<?php

namespace App\Controllers;

use Framework\managers\TicketManager;

class BlogController extends Controller
{
    public function welcome(){
        return $this->view('blog.welcome');
    }

    public function posts(){
        if(!isset($_SESSION['user_ID']))
            header('Location: /metahub/login');
        $ticketManager = new TicketManager();
        $tickets = $ticketManager->getTickets();
        return $this->view('blog.posts', compact('tickets'));
    }

    public function show(int $id){
        if(!isset($_SESSION['user_ID']))
            return $this->view('connexion.login');
        $ticketManager = new TicketManager();
        $ticket = $ticketManager->getTicketsWithCondition($id);
        return $this->view('blog.show', compact('id', 'ticket'));
    }
}