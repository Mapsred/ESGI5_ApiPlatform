<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AirStripRepository")
 */
class AirStrip
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="Airplane", mappedBy="airstrip")
     */
    private $airplanes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="airstrips")
     */
    private $airport;

    public function __construct()
    {
        $this->airplanes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Airplane[]
     */
    public function getAirplanes(): Collection
    {
        return $this->airplanes;
    }

    public function addPlane(Airplane $plane): self
    {
        if (!$this->airplanes->contains($plane)) {
            $this->airplanes[] = $plane;
            $plane->setAirstrip($this);
        }

        return $this;
    }

    public function removePlane(Airplane $plane): self
    {
        if ($this->airplanes->contains($plane)) {
            $this->airplanes->removeElement($plane);
            // set the owning side to null (unless already changed)
            if ($plane->getAirstrip() === $this) {
                $plane->setAirstrip(null);
            }
        }

        return $this;
    }

    public function getAirport(): ?Airport
    {
        return $this->airport;
    }

    public function setAirport(?Airport $airport): self
    {
        $this->airport = $airport;

        return $this;
    }
}
