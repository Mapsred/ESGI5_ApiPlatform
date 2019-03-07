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
        $resRepartition = floor($nPlaces / $nClasses);
        $modulo = $nPlaces % $nClasses;
        $ret = [];
        for($i = 1; $i < $nClasses; $i++) {
            $ret[$i] = $resRepartition;
        }
        if(!empty($ret)) {
            $index = 1;
            while($modulo > 0) {
                if(!isset($ret[$index])){
                    $index = 1;
                }
                $ret[$index] += 1;
                $index++;
                $modulo--;
            }
        }

        return $ret;
    }

    public function getOrder()
    {
        return 5;
    }
}
