<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalleRepository::class)
 */
class Salle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $numeroSalle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatSalle;

    /**
     * @ORM\ManyToOne(targetEntity=Zone::class, inversedBy="salles")
     */
    private $zone;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="salle")
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

    public function getNumeroSalle(): ?string
    {
        return $this->numeroSalle;
    }

    public function setNumeroSalle(string $numeroSalle): self
    {
        $this->numeroSalle = $numeroSalle;

        return $this;
    }

    public function getEtatSalle(): ?string
    {
        return $this->etatSalle;
    }

    public function setEtatSalle(string $etatSalle): self
    {
        $this->etatSalle = $etatSalle;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

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
            $ticket->setSalle($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSalle() === $this) {
                $ticket->setSalle(null);
            }
        }

        return $this;
    }
}
