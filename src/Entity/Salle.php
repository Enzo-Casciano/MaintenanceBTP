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
     * @ORM\Column(type="string", length=10)
     */
    private $numeroSalle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etatSalle;


    /**
     * @ORM\ManyToMany(targetEntity=Zone::class, mappedBy="salle", cascade={"persist"})
     */
    private $zones;

    /**
     * @ORM\ManyToMany(targetEntity=Ticket::class, inversedBy="salles")
     */
    private $ticket;

    public function __construct()
    {
        $this->zones = new ArrayCollection();
        $this->ticket = new ArrayCollection();
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


    // /**
    //  * @return Collection|Ticket[]
    //  */
    // public function getTickets(): Collection
    // {
    //     return $this->tickets;
    // }


    /**
     * @return Collection|Zone[]
     */
    public function getZones(): Collection
    {
        return $this->zones;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
            $zone->addSalle($this);
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        if ($this->zones->removeElement($zone)) {
            $zone->removeSalle($this);
        }

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

}
