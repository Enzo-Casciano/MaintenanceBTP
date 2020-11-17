<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
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
    private $titreTicket;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionTicket;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTicket;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="tickets")
     */
    private $utilisateur;

    /**
     * @ORM\OneToOne(targetEntity=Intervention::class, cascade={"persist", "remove"})
     */
    private $intervention;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="tickets")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=Statut::class, inversedBy="tickets")
     */
    private $statut;

    /**
     * @ORM\ManyToMany(targetEntity=Materiel::class, mappedBy="ticket")
     */
    private $materiels;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $categorieTicket;


    public function __construct()
    {
        $this->materiels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreTicket(): ?string
    {
        return $this->titreTicket;
    }

    public function setTitreTicket(string $titreTicket): self
    {
        $this->titreTicket = $titreTicket;

        return $this;
    }

    public function getDescriptionTicket(): ?string
    {
        return $this->descriptionTicket;
    }

    public function setDescriptionTicket(string $descriptionTicket): self
    {
        $this->descriptionTicket = $descriptionTicket;

        return $this;
    }

    public function getDateTicket(): ?\DateTimeInterface
    {
        return $this->dateTicket;
    }

    public function setDateTicket(\DateTimeInterface $dateTicket): self
    {
        $this->dateTicket = $dateTicket;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getIntervention(): ?Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(?Intervention $intervention): self
    {
        $this->intervention = $intervention;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->addTicket($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            $materiel->removeTicket($this);
        }

        return $this;
    }

    public function getCategorieTicket(): ?string
    {
        return $this->categorieTicket;
    }

    public function setCategorieTicket(string $categorieTicket): self
    {
        $this->categorieTicket = $categorieTicket;

        return $this;
    }
}
