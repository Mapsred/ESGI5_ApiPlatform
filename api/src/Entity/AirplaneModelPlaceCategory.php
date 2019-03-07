<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AirplaneModelPlaceCategoryRepository")
 */
class AirplaneModelPlaceCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AirplaneModel", inversedBy="airplaneModelPlaceCategories")
     */
    private $airplaneModel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlaceCategory", inversedBy="airplaneModelPlaceCategories")
     */
    private $placeCategory;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAirplaneModel(): ?AirplaneModel
    {
        return $this->airplaneModel;
    }

    public function setAirplaneModel(?AirplaneModel $airplaneModel): self
    {
        $this->airplaneModel = $airplaneModel;

        return $this;
    }

    public function getPlaceCategory(): ?PlaceCategory
    {
        return $this->placeCategory;
    }

    public function setPlaceCategory(?PlaceCategory $placeCategory): self
    {
        $this->placeCategory = $placeCategory;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
