<?php
require_once 'views/View.php';
class ControllerAccueil
{
    private $_ticketManager;
    private $_view;

    /**
     * @throws Exception
     */
    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->tickets();
    }

    private function tickets()
    {
        $this->_ticketManager = new TicketManager();
        $tickets = $this->_ticketManager->getTickets();

        $this->_view = new View('Accueil');
        $this->_view->generate(array('tickets' => $tickets));
    }
}
