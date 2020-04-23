<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExcursionRepository")
 */
class Excursion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeRecommandee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailExcursion", mappedBy="excursion")
     */
    private $detailExcursions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DescriptionExcursion", mappedBy="type")
     */
    private $descriptionExcursions;

    public function __construct()
    {
        $this->detailExcursions = new ArrayCollection();
        $this->descriptionExcursions = new ArrayCollection();
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

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
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
            $detailExcursion->setExcursion($this);
        }

        return $this;
    }

    public function removeDetailExcursion(DetailExcursion $detailExcursion): self
    {
        if ($this->detailExcursions->contains($detailExcursion)) {
            $this->detailExcursions->removeElement($detailExcursion);
            // set the owning side to null (unless already changed)
            if ($detailExcursion->getExcursion() === $this) {
                $detailExcursion->setExcursion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DescriptionExcursion[]
     */
    public function getDescriptionExcursions(): Collection
    {
        return $this->descriptionExcursions;
    }

    public function addDescriptionExcursion(DescriptionExcursion $descriptionExcursion): self
    {
        if (!$this->descriptionExcursions->contains($descriptionExcursion)) {
            $this->descriptionExcursions[] = $descriptionExcursion;
            $descriptionExcursion->setType($this);
        }

        return $this;
    }

    public function removeDescriptionExcursion(DescriptionExcursion $descriptionExcursion): self
    {
        if ($this->descriptionExcursions->contains($descriptionExcursion)) {
            $this->descriptionExcursions->removeElement($descriptionExcursion);
            // set the owning side to null (unless already changed)
            if ($descriptionExcursion->getType() === $this) {
                $descriptionExcursion->setType(null);
            }
        }

        return $this;
    }

}
