<?php

namespace App\DataFixtures;

use App\Entity\AirplaneModel;
use App\Entity\AirplaneModelPlaceCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AirplaneModelPlaceCategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $airplaneModels = $manager->getRepository(AirplaneModel::class)->findAll();

        foreach ($airplaneModels as $airplaneModel) {

            $nPlaces = rand(10, 30);
            $nClasses = rand(1, 3);

            $repartition = $this->getRepartitionPlacesByClass($nPlaces, $nClasses);

            foreach ($repartition as $places) {

                $airplaneModelPlaceCategory = new AirplaneModelPlaceCategory();
                $airplaneModelPlaceCategory->setNumber($places);
                $airplaneModelPlaceCategory->setAirplaneModel($airplaneModel);
                $manager->persist($airplaneModelPlaceCategory);
            }
        }

        $manager->flush();
    }

    private function getRepartitionPlacesByClass(int $nPlaces, int $nClasses) :array {

        $res = [];
        $currClass = 1;

        while ($nPlaces > 0) {
            if($currClass > $nClasses)
                $currClass = 1;

            $res[$currClass] = isset($res[$currClass]) ? $res[$currClass] + 1 : 1;

            $nPlaces--;
            $currClass++;
        }

        return $res;
    }

    public function getOrder()
    {
        return 5;
    }
}
