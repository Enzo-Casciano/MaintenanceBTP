<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterventionRepository::class)
 */
class Intervention
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
    private $descriptionIntervention;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $statutIntervention;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebutIntervention;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFinIntervention;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="interventions")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionIntervention(): ?string
    {
        return $this->descriptionIntervention;
    }

    public function setDescriptionIntervention(string $descriptionIntervention): self
    {
        $this->descriptionIntervention = $descriptionIntervention;

        return $this;
    }

    public function getStatutIntervention(): ?string
    {
        return $this->statutIntervention;
    }

    public function setStatutIntervention(string $statutIntervention): self
    {
        $this->statutIntervention = $statutIntervention;

        return $this;
    }

    public function getDateDebutIntervention(): ?\DateTimeInterface
    {
        return $this->dateDebutIntervention;
    }

    public function setDateDebutIntervention(\DateTimeInterface $dateDebutIntervention): self
    {
        $this->dateDebutIntervention = $dateDebutIntervention;

        return $this;
    }

    public function getDateFinIntervention(): ?\DateTimeInterface
    {
        return $this->dateFinIntervention;
    }

    public function setDateFinIntervention(\DateTimeInterface $dateFinIntervention): self
    {
        $this->dateFinIntervention = $dateFinIntervention;

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
