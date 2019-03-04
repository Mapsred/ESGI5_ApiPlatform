<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CopyBookRepository")
 */
class CopyBook
{
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int $copy_book_number
     * @ORM\Column(type="integer")
     */
    private $copy_book_number;

    /**
     * @var Book $book
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="copyBooks")
     */
    private $book;

    /**
     * @var ArrayCollection $borrows
     * @ORM\OneToMany(targetEntity="App\Entity\Borrow", mappedBy="copy_book")
     */
    private $borrows;

    public function __construct()
    {
        $this->borrows = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCopyBookNumber(): ?int
    {
        return $this->copy_book_number;
    }

    /**
     * @param int $copy_book_number
     * @return CopyBook
     */
    public function setCopyBookNumber(int $copy_book_number): self
    {
        $this->copy_book_number = $copy_book_number;

        return $this;
    }

    /**
     * @return Book|null
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @param Book|null $book
     * @return CopyBook
     */
    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrow $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setCopyBook($this);
        }

        return $this;
    }

    public function removeBorrow(Borrow $borrow): self
    {
        if ($this->borrows->contains($borrow)) {
            $this->borrows->removeElement($borrow);
            // set the owning side to null (unless already changed)
            if ($borrow->getCopyBook() === $this) {
                $borrow->setCopyBook(null);
            }
        }

        return $this;
    }
}
