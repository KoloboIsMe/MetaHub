<?php

namespace App\Controllers;

use Framework\managers\TicketManager;

class BlogController extends Controller
{
    public function welcome(){
        return $this->view('blog.welcome');
    }

    public function posts(){
        $ticketManager = new TicketManager();
        $tickets = $ticketManager->getTickets();
        return $this->view('blog.posts', compact('tickets'));
    }

    public function show(int $id){
        $ticketManager = new TicketManager();
        $ticket = $ticketManager->getTicketsWithCondition($id);
        return $this->view('blog.show', compact('id', 'ticket'));
    }
}