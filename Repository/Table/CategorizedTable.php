<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////  CATEGORIZED TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Categorized' table singleton.
/// TODO : Apply parameters verification to methods.
/// TODO : Create static filtering functions for the select records
namespace Framework\Database\Table;

use Categorized;
use Framework\Database\Entity\Ticket;
use Framework\database\Record;

class CategorizedTable
{
    use BasicTable;
    const TABLE = CATEGORIZED_TABLE;
    private function newEntity(array $data) : Categorized
    {
        $ticket = $data[0];
        $category = $data[1];
        return new Categorized($ticket, $category);
    }
    public function categoriesOf(Ticket|int $ticket) : array|bool
    {
        $ticketId = is_int($ticket) ? $ticket : $ticket->getId();
        if(($record = $this->select($ticketId)) === FALSE)
        {
            return FALSE;
        }
        $categories = array();
        foreach ($record->getData() as $ticket) {
            $categories[] = $ticket->category();
        }
        return $categories;
    }
    public function categorize(int|Ticket $ticket,Category|array ...$categories) : bool
        // Categorize a given ticket. Can take a Ticket or a ticket ID in argument,
        // and either an array or many categories / categories ID
    {
        if(is_array($categories[0]))
        {
            $tmp = $categories;
            unset($categories);
            foreach ($tmp[0] as $category)
            {
                $categories[] = $category;
            }
        }
        $ticketID = is_int($ticket) ? $ticket : $ticket->getID();
        foreach ($categories as $category)
        {
            $categoryID = is_int($category) ? $category : $category->getID();
            $request[] = new \Framework\Database\Entity\Categorized($ticketID, $categoryID);
        }
        if (($this->insert($request)) === FALSE)
        {
            return FALSE;
        }
        return TRUE;
    }
    public function select(int $ticket = null, int $category = null) : Record|bool
    {
        $request = 'SELECT * FROM ' . self::TABLE;
        if (isset($ticket) && isset($category))
        {
            $request .= " WHERE 'ticket' = $ticket AND category = $category";
        }
        elseif (isset($ticket))
        {
            $request .= " WHERE 'ticket' = $ticket";
        }
        elseif (isset($category))
        {
            $request .= " WHERE 'category' = $category";
        }
        return $this->execute($request);
    }
    public function delete(string $key, int ...$IDs) : bool
    {
        if ($key !== 'ticket' && $key !== 'category')
        {
            return FALSE;
        }
        foreach($IDs as $ID)
        {
            $request = 'DELETE FROM ' . self::TABLE . " WHERE '$key' = $ID";
            if ($this->execute($request) === FALSE)
            {
                return FALSE;
            }
        }
        return TRUE;
    }
}