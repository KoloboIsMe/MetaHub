<?php
interface TicketInterface{
    public function getTickets();

    public function getTicketsWithCondition(int $id);
}