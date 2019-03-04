<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\CopyBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture
{
    const BOOK_1_REFERENCE = "book_1";
    const BOOK_2_REFERENCE = "book_2";
    const BOOK_3_REFERENCE = "book_3";

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        /** @var Author $author */
        $author = $this->getReference(AuthorFixtures::AUTHOR_REFERENCE);

        $copyBooks = [];

        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book
                ->setAuthor($author)
                ->setReference($faker->uuid)
                ->setDescription($faker->text)
                ->setName($faker->colorName)
                ->setPublicationDate(new \DateTime());

            $manager->persist($book);

            for ($j = 0; $j < rand(1, 5); $j++) {
                $copyBook = new CopyBook();
                $copyBook
                    ->setBook($book)
                    ->setCopyBookNumber($j);

                $manager->persist($copyBook);
                $copyBooks[] = $copyBook;
            }
        }

        $this->setReference(self::BOOK_1_REFERENCE, $copyBooks[0]);
        $this->setReference(self::BOOK_2_REFERENCE, $copyBooks[1]);
        $this->setReference(self::BOOK_3_REFERENCE, $copyBooks[2]);

        $manager->flush();
    }
}
