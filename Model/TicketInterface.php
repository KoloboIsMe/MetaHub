<?php
interface TicketInterface{
    public function getTickets();

    public function getTicketById($id);

    public function getTicketsWithCategory($CategoryID);
}