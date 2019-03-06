<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AirplanePlaceRepository")
 */
class AirplanePlace
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airplane", inversedBy="airplanePlaces")
     */
    private $airplane;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaceCategory", mappedBy="airplanePlace")
     */
    private $placeCategory;

    public function __construct()
    {
        $this->placeCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAirplane(): ?Airplane
    {
        return $this->airplane;
    }

    public function setAirplane(?Airplane $airplane): self
    {
        $this->airplane = $airplane;

        return $this;
    }

    /**
     * @return Collection|PlaceCategory[]
     */
    public function getPlaceCategory(): Collection
    {
        return $this->placeCategory;
    }

    public function addPlaceCategory(PlaceCategory $placeCategory): self
    {
        if (!$this->placeCategory->contains($placeCategory)) {
            $this->placeCategory[] = $placeCategory;
            $placeCategory->setAirplanePlace($this);
        }

        return $this;
    }

    public function removePlaceCategory(PlaceCategory $placeCategory): self
    {
        if ($this->placeCategory->contains($placeCategory)) {
            $this->placeCategory->removeElement($placeCategory);
            // set the owning side to null (unless already changed)
            if ($placeCategory->getAirplanePlace() === $this) {
                $placeCategory->setAirplanePlace(null);
            }
        }

        return $this;
    }
}
