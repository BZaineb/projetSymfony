<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeRecommandee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailVisite", mappedBy="detailVisite")
     */
    private $detailVisites;

    public function __construct()
    {
        $this->detailVisites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDureeRecommandee(): ?int
    {
        return $this->dureeRecommandee;
    }

    public function setDureeRecommandee(int $dureeRecommandee): self
    {
        $this->dureeRecommandee = $dureeRecommandee;

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
            $detailVisite->setDetailVisite($this);
        }

        return $this;
    }

    public function removeDetailVisite(DetailVisite $detailVisite): self
    {
        if ($this->detailVisites->contains($detailVisite)) {
            $this->detailVisites->removeElement($detailVisite);
            // set the owning side to null (unless already changed)
            if ($detailVisite->getDetailVisite() === $this) {
                $detailVisite->setDetailVisite(null);
            }
        }

        return $this;
    }
}
