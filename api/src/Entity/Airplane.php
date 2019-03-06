<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlaneRepository")
 */
class Airplane
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="airplanes")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AirStrip", inversedBy="airplanes")
     */
    private $airstrip;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Staff", mappedBy="airplane")
     */
    private $staff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="airplanes")
     */
    private $airport;

    public function __construct()
    {
        $this->staff = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAirstrip(): ?AirStrip
    {
        return $this->airstrip;
    }

    public function setAirstrip(?AirStrip $airstrip): self
    {
        $this->airstrip = $airstrip;

        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff[] = $staff;
            $staff->setAirplane($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->contains($staff)) {
            $this->staff->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getAirplane() === $this) {
                $staff->setAirplane(null);
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
