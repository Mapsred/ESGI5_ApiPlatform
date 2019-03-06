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
     * @ORM\OneToMany(targetEntity="App\Entity\Plane", mappedBy="airport")
     */
    private $planes;

    public function __construct()
    {
        $this->airstrips = new ArrayCollection();
        $this->planes = new ArrayCollection();
    }

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

    public function addAirstrip(AirStrip $airstrip): self
    {
        if (!$this->airstrips->contains($airstrip)) {
            $this->airstrips[] = $airstrip;
            $airstrip->setAirport($this);
        }

        return $this;
    }

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
     * @return Collection|Plane[]
     */
    public function getPlanes(): Collection
    {
        return $this->planes;
    }

    public function addPlane(Plane $plane): self
    {
        if (!$this->planes->contains($plane)) {
            $this->planes[] = $plane;
            $plane->setAirport($this);
        }

        return $this;
    }

    public function removePlane(Plane $plane): self
    {
        if ($this->planes->contains($plane)) {
            $this->planes->removeElement($plane);
            // set the owning side to null (unless already changed)
            if ($plane->getAirport() === $this) {
                $plane->setAirport(null);
            }
        }

        return $this;
    }
}
