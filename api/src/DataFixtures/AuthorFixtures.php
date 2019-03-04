<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixtures extends Fixture
{
    const AUTHOR_REFERENCE = "author_1";

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $author = new Author();
            $author
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setAge($faker->numberBetween(2, 30));

            $manager->persist($author);
            $this->setReference(self::AUTHOR_REFERENCE, $author);
        }


        $manager->flush();
    }
}
