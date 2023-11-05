<?php

namespace services;

interface TicketInterface
{
    public function existsTicket($ticketID);

    public function getTicketsID();

    public function get5LastTicketsID();

    public function createTicket($title, $message, $date, $author);

    public function editTicket($id, $title, $message);

    public function isTicketOwner($ticketID, $userID);
}