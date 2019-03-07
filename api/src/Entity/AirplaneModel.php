<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"airplane_model_read"}},
 *     denormalizationContext={"groups"={"airplane_model_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AirplaneModelRepository")
 */
class AirplaneModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"airplane_model_write", "airplane_model_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"airplane_model_write", "airplane_model_read"})
     */
    private $length;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"airplane_model_write", "airplane_model_read"})
     */
    private $height;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AirplaneModelPlaceCategory", mappedBy="airplaneModel")
     * @Groups({"airplane_model_read"})
     */
    private $airplaneModelPlaceCategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Airplane", mappedBy="airplaneModel")
     * @Groups({"airplane_model_read"})
     */
    private $airplanes;

    public function __construct()
    {
        $this->airplaneModelPlaceCategories = new ArrayCollection();
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

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

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
            $airplaneModelPlaceCategory->setAirplaneModel($this);
        }

        return $this;
    }

    public function removeAirplaneModelPlaceCategory(AirplaneModelPlaceCategory $airplaneModelPlaceCategory): self
    {
        if ($this->airplaneModelPlaceCategories->contains($airplaneModelPlaceCategory)) {
            $this->airplaneModelPlaceCategories->removeElement($airplaneModelPlaceCategory);
            // set the owning side to null (unless already changed)
            if ($airplaneModelPlaceCategory->getAirplaneModel() === $this) {
                $airplaneModelPlaceCategory->setAirplaneModel(null);
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

    public function addAirplane(Airplane $airplane): self
    {
        if (!$this->airplanes->contains($airplane)) {
            $this->airplanes[] = $airplane;
            $airplane->setAirplaneModel($this);
        }

        return $this;
    }

    public function removeAirplane(Airplane $airplane): self
    {
        if ($this->airplanes->contains($airplane)) {
            $this->airplanes->removeElement($airplane);
            // set the owning side to null (unless already changed)
            if ($airplane->getAirplaneModel() === $this) {
                $airplane->setAirplaneModel(null);
            }
        }

        return $this;
    }
}
