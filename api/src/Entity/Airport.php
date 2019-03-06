<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AirportRepository")
 */
class Airport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AirStrip", mappedBy="airport")
     */
    private $airstrips;

    /**
     * @ORM\OneToMany(targetEntity="Airplane", mappedBy="airport")
     */
    private $airplanes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * Airport constructor.
     */
    public function __construct()
    {
        $this->airstrips = new ArrayCollection();
        $this->airplanes = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|AirStrip[]
     */
    public function getAirstrips(): Collection
    {
        return $this->airstrips;
    }

    /**
     * @param AirStrip $airstrip
     * @return Airport
     */
    public function addAirstrip(AirStrip $airstrip): self
    {
        if (!$this->airstrips->contains($airstrip)) {
            $this->airstrips[] = $airstrip;
            $airstrip->setAirport($this);
        }

        return $this;
    }

    /**
     * @param AirStrip $airstrip
     * @return Airport
     */
    public function removeAirstrip(AirStrip $airstrip): self
    {
        if ($this->airstrips->contains($airstrip)) {
            $this->airstrips->removeElement($airstrip);
            // set the owning side to null (unless already changed)
            if ($airstrip->getAirport() === $this) {
                $airstrip->setAirport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Airplane[]
     */
    public function getAirplanes(): Collection
    {
        return $this->airplanes;
    }

    /**
     * @param Airplane $plane
     * @return Airport
     */
    public function addPlane(Airplane $plane): self
    {
        if (!$this->airplanes->contains($plane)) {
            $this->airplanes[] = $plane;
            $plane->setAirport($this);
        }

        return $this;
    }

    /**
     * @param Airplane $plane
     * @return Airport
     */
    public function removePlane(Airplane $plane): self
    {
        if ($this->airplanes->contains($plane)) {
            $this->airplanes->removeElement($plane);
            // set the owning side to null (unless already changed)
            if ($plane->getAirport() === $this) {
                $plane->setAirport(null);
            }
        }

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
