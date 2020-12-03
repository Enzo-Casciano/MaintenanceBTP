<?php

namespace App\Entity;

use App\Repository\CriticiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CriticiteRepository::class)
 */
class Criticite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCriticite;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="criticite")
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCriticite(): ?string
    {
        return $this->nomCriticite;
    }

    public function setNomCriticite(string $nomCriticite): self
    {
        $this->nomCriticite = $nomCriticite;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setCriticite($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getCriticite() === $this) {
                $ticket->setCriticite(null);
            }
        }

        return $this;
    }

}
