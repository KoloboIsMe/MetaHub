<?php

namespace service;

interface TicketInterface{

    public function getPostById($ticketid);
    public function getTicketsID();
    public function get5LastTicketsID();
    public function createTicket($title, $message, $date, $author);
    public function addCategoryToTicket($category, $ticketID);
    public function getCategoryIdByLabel($label);
    public function deleteTicket($ticketID);
}