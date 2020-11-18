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
     * @ORM\ManyToMany(targetEntity=Ticket::class, inversedBy="salles")
     */
    private $ticket;

    /**
     * @ORM\ManyToMany(targetEntity=Ticket::class, mappedBy="salle")
     */
    private $tickets;

    /**
     * @ORM\ManyToMany(targetEntity=Zone::class, inversedBy="salles")
     */
    private $zone;

    public function __construct()
    {
        $this->ticket = new ArrayCollection();
        $this->zone = new ArrayCollection();
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

    /**
     * @return Collection|Ticket[]
     */
    public function getTicket(): Collection
    {
        return $this->ticket;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->ticket->contains($ticket)) {
            $this->ticket[] = $ticket;
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        $this->ticket->removeElement($ticket);

        return $this;
    }

    /**
     * @return Collection|Zone[]
     */
    public function getZone(): Collection
    {
        return $this->zone;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zone->contains($zone)) {
            $this->zone[] = $zone;
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        $this->zone->removeElement($zone);

        return $this;
    }

}
