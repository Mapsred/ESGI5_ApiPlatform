<?php

namespace App\DataFixtures;

use App\Entity\AirplaneModel;
use App\Entity\AirplanePlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AirplanePlaceFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $airplaneModels = $manager->getRepository(AirplaneModel::class)->findAll();

        foreach ($airplaneModels as $airplaneModel) {
            $airplaneModelPlaceCategoriesCollection = $airplaneModel->getAirplaneModelPlaceCategories();
            $namePlace = 0;
            foreach ($airplaneModelPlaceCategoriesCollection as $airplaneModelPlaceCategoriesItem) {
                $numberCategory = $airplaneModelPlaceCategoriesItem->getNumber();
                $placeCategory = $airplaneModelPlaceCategoriesItem->getPlaceCategory();
                for ($i = 0; $i < $numberCategory; $i++){
                    $namePlace++;
                    $airplanePlace = new AirplanePlace();
                    $airplanePlace->setPlaceCategory($placeCategory);
                    $airplanePlace->setName($namePlace);
                    $manager->persist($airplanePlace);
                }
            }
        }


        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}
