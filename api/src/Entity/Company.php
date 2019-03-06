<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\OneToMany(targetEntity="Airplane", mappedBy="company")
     */
    private $airplanes;

    public function __construct()
    {
        $this->airplanes = new ArrayCollection();
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
            $plane->setCompany($this);
        }

        return $this;
    }

    public function removePlane(Airplane $plane): self
    {
        if ($this->airplanes->contains($plane)) {
            $this->airplanes->removeElement($plane);
            // set the owning side to null (unless already changed)
            if ($plane->getCompany() === $this) {
                $plane->setCompany(null);
            }
        }

        return $this;
    }
}
