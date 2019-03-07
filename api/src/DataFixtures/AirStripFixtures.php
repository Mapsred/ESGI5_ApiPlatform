<?php

namespace App\DataFixtures;

use App\Entity\Airport;
use App\Entity\AirStrip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AirStripFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $airports = $manager->getRepository(Airport::class)->findAll();
        foreach ($airports as $airport) {
            for ($i = 0; $i < rand(2, 8); $i++) {
                $airstrip = new AirStrip();
                $airstrip
                    ->setAirport($airport)
                    ->setLabel(sprintf("AirStrip %s", $i));

                $manager->persist($airstrip);
            }
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
