<?php

namespace App\DataFixtures;

use App\Entity\Airport;
use App\Entity\AirStrip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AirStripFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $airports = $manager->getRepository(Airport::class)->findAll();
        foreach ($airports as $airport) {
            for ($i = 0; $i > rand(1, 5); $i++) {
                $airstrip = new AirStrip();
                $airstrip
                    ->setAirport($airport)
                    ->setLabel(sprintf("AirStrip %s", $i));

                $manager->persist($airstrip);
            }
        }

        $manager->flush();
    }
}
