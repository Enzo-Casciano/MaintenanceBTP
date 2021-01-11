<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomUtilisateur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomUtilisateur;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mailUtilisateur;
    
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $mdp;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="utilisateurs")
     */
    private $role;


    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="utilisateur")
     */
    private $tickets;



    public function __construct()
    {
        $this->interventions = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }
    
    public function getMailUtilisateur(): ?string
    {
        return $this->mailUtilisateur;
    }
    
    public function setMailUtilisateur(string $mailUtilisateur): self
    {
        $this->mailUtilisateur = $mailUtilisateur;
        
        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

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
            $ticket->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getUtilisateur() === $this) {
                $ticket->setUtilisateur(null);
            }
        }

        return $this;
    }




}
