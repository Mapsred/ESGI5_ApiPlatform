<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlaceCategoryRepository")
 */
class PlaceCategory
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
     * @ORM\Column(type="integer")
     */
    private $rank;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AirplaneModelPlaceCategory", mappedBy="placeCategory")
     */
    private $airplaneModelPlaceCategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AirplanePlace", mappedBy="placeCategory")
     */
    private $airplanePlaces;

    public function __construct()
    {
        $this->airplaneModelPlaceCategories = new ArrayCollection();
        $this->airplanePlaces = new ArrayCollection();
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

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return Collection|AirplaneModelPlaceCategory[]
     */
    public function getAirplaneModelPlaceCategories(): Collection
    {
        return $this->airplaneModelPlaceCategories;
    }

    public function addAirplaneModelPlaceCategory(AirplaneModelPlaceCategory $airplaneModelPlaceCategory): self
    {
        if (!$this->airplaneModelPlaceCategories->contains($airplaneModelPlaceCategory)) {
            $this->airplaneModelPlaceCategories[] = $airplaneModelPlaceCategory;
            $airplaneModelPlaceCategory->setPlaceCategory($this);
        }

        return $this;
    }

    public function removeAirplaneModelPlaceCategory(AirplaneModelPlaceCategory $airplaneModelPlaceCategory): self
    {
        if ($this->airplaneModelPlaceCategories->contains($airplaneModelPlaceCategory)) {
            $this->airplaneModelPlaceCategories->removeElement($airplaneModelPlaceCategory);
            // set the owning side to null (unless already changed)
            if ($airplaneModelPlaceCategory->getPlaceCategory() === $this) {
                $airplaneModelPlaceCategory->setPlaceCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AirplanePlace[]
     */
    public function getAirplanePlaces(): Collection
    {
        return $this->airplanePlaces;
    }

    public function addAirplanePlace(AirplanePlace $airplanePlace): self
    {
        if (!$this->airplanePlaces->contains($airplanePlace)) {
            $this->airplanePlaces[] = $airplanePlace;
            $airplanePlace->setPlaceCategory($this);
        }

        return $this;
    }

    public function removeAirplanePlace(AirplanePlace $airplanePlace): self
    {
        if ($this->airplanePlaces->contains($airplanePlace)) {
            $this->airplanePlaces->removeElement($airplanePlace);
            // set the owning side to null (unless already changed)
            if ($airplanePlace->getPlaceCategory() === $this) {
                $airplanePlace->setPlaceCategory(null);
            }
        }

        return $this;
    }
}
