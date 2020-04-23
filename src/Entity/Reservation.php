<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPersonne;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $categorieHebergement;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailVisite", mappedBy="reservation")
     */
    private $detailVisites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailExcursion", mappedBy="reservation")
     */
    private $detailExcursions;

    public function __construct()
    {
        $this->detailVisites = new ArrayCollection();
        $this->detailExcursions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne(int $nbPersonne): self
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    public function getCategorieHebergement(): ?string
    {
        return $this->categorieHebergement;
    }

    public function setCategorieHebergement(string $categorieHebergement): self
    {
        $this->categorieHebergement = $categorieHebergement;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|DetailVisite[]
     */
    public function getDetailVisites(): Collection
    {
        return $this->detailVisites;
    }

    public function addDetailVisite(DetailVisite $detailVisite): self
    {
        if (!$this->detailVisites->contains($detailVisite)) {
            $this->detailVisites[] = $detailVisite;
            $detailVisite->setReservation($this);
        }

        return $this;
    }

    public function removeDetailVisite(DetailVisite $detailVisite): self
    {
        if ($this->detailVisites->contains($detailVisite)) {
            $this->detailVisites->removeElement($detailVisite);
            // set the owning side to null (unless already changed)
            if ($detailVisite->getReservation() === $this) {
                $detailVisite->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DetailExcursion[]
     */
    public function getDetailExcursions(): Collection
    {
        return $this->detailExcursions;
    }

    public function addDetailExcursion(DetailExcursion $detailExcursion): self
    {
        if (!$this->detailExcursions->contains($detailExcursion)) {
            $this->detailExcursions[] = $detailExcursion;
            $detailExcursion->setReservation($this);
        }

        return $this;
    }

    public function removeDetailExcursion(DetailExcursion $detailExcursion): self
    {
        if ($this->detailExcursions->contains($detailExcursion)) {
            $this->detailExcursions->removeElement($detailExcursion);
            // set the owning side to null (unless already changed)
            if ($detailExcursion->getReservation() === $this) {
                $detailExcursion->setReservation(null);
            }
        }

        return $this;
    }

}
