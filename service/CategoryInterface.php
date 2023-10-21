<?php
interface CategoryInterface{
    public function getCategories();
    public function getCategoryById($id);
    public function getCategoriesWithTicket($ticketID);


}
