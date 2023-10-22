<?php
interface TicketInterface{
    public function getTickets();

    public function getTicketById($id);

    public function get5LastTickets();

    public function getTicketsWithCategory($CategoryID);

}