<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book_read"}},
 *     denormalizationContext={"groups"={"book_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $reference
     * @ORM\Column(type="string", length=255)
     * @Groups({"book_read", "book_write"})
     */
    private $reference;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=255)
     * @Groups({"book_read", "book_write"})
     */
    private $name;

    /**
     * @var string $description
     * @ORM\Column(type="text")
     * @Groups({"book_read", "book_write"})
     */
    private $description;

    /**
     * @var \DateTime $publication_date
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Groups({"book_read", "book_write"})
     */
    private $publication_date;

    /**
     * @var Author $author
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     * @ApiSubresource()
     * @Groups({"book_read", "book_write"})
     */
    private $author;

    /**
     * @var ArrayCollection $copyBooks
     * @ORM\OneToMany(targetEntity="App\Entity\CopyBook", mappedBy="book")
     * @Groups({"book_read"})
     */
    private $copyBooks;

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->copyBooks = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Book
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Book
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Book
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPublicationDate(): ?\DateTime
    {
        return $this->publication_date;
    }

    /**
     * @param \DateTime $publication_date
     * @return Book
     */
    public function setPublicationDate(\DateTime $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    /**
     * @return Author|null
     */
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    /**
     * @param Author|null $author
     * @return Book
     */
    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|CopyBook[]
     */
    public function getCopyBooks(): Collection
    {
        return $this->copyBooks;
    }

    /**
     * @param CopyBook $copyBook
     * @return Book
     */
    public function addCopyBook(CopyBook $copyBook): self
    {
        if (!$this->copyBooks->contains($copyBook)) {
            $this->copyBooks[] = $copyBook;
            $copyBook->setBook($this);
        }

        return $this;
    }

    /**
     * @param CopyBook $copyBook
     * @return Book
     */
    public function removeCopyBook(CopyBook $copyBook): self
    {
        if ($this->copyBooks->contains($copyBook)) {
            $this->copyBooks->removeElement($copyBook);
            // set the owning side to null (unless already changed)
            if ($copyBook->getBook() === $this) {
                $copyBook->setBook(null);
            }
        }

        return $this;
    }
}
