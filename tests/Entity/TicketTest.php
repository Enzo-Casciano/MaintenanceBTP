<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Ticket;

class TicketTest extends TestCase
{
    public function testTitreTicket() 
    { 
        $ticket = new Ticket(); 
        $titre = "Test 1";
        $ticket->setTitreTicket($titre);
        $this->assertEquals("Test 1", $ticket->getTitreTicket());
    }
}
