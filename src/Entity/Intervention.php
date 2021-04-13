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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionIntervention;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionRefus;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;


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

    public function getDescriptionRefus(): ?string
    {
        return $this->descriptionRefus;
    }
    
    public function setDescriptionRefus(?string $descriptionRefus): self
    {
        $this->descriptionRefus = $descriptionRefus;
    
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }
}
