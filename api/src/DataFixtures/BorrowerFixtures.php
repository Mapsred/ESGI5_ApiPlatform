<?php

namespace App\DataFixtures;

use App\Entity\Borrow;
use App\Entity\Borrower;
use App\Entity\CopyBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BorrowerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        /** @var CopyBook[] $copyBooks */
        $copyBooks = [
            $this->getReference(BookFixtures::BOOK_1_REFERENCE),
            $this->getReference(BookFixtures::BOOK_2_REFERENCE),
            $this->getReference(BookFixtures::BOOK_3_REFERENCE)
        ];

        for ($i = 0; $i < 3; $i++) {
            $borrower = new Borrower();
            $borrower
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setAddress($faker->address)
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber);

            $manager->persist($borrower);
            $borrow = new Borrow();
            $borrow
                ->setBorrower($borrower)
                ->setBorrowindDate((new \DateTime())->sub(new \DateInterval("P10D")))
                ->setCopyBook($copyBooks[$i])
                ->setReturnDate((new \DateTime())->add(new \DateInterval("P10D")))
                ->setState("borrowed");

            $manager->persist($borrow);
        }

        $manager->flush();
    }
}
