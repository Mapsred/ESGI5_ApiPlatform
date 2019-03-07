<?php

namespace App\DataFixtures;

use App\Entity\AirplaneModel;
use App\Entity\PlaceCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PlaceCategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $airplaneModels = $manager->getRepository(AirplaneModel::class)->findAll();

        foreach ($airplaneModels as $airplaneModel) {
            $airplaneModelPlaceCategoriesCollection = $airplaneModel->getAirplaneModelPlaceCategories();
            $rank = 1;
            foreach ($airplaneModelPlaceCategoriesCollection as $airplaneModelPlaceCategoriesItem) {
                $placeCategory = new PlaceCategory();
                $placeCategory->setName($faker->word . ' class');
                $placeCategory->setRank($rank);
                $rank++;
                $airplaneModelPlaceCategoriesItem->setPlaceCategory($placeCategory);
                $manager->persist($placeCategory);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
