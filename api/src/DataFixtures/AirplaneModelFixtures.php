<?php

namespace App\DataFixtures;

use App\Entity\AirplaneModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AirplaneModelFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $alphabet = 'abcdefghijklmnopqrstuvxyz';
        $faker = Factory::create('fr_FR');
        $nModels = 10;
        for($i = 0; $i < $nModels; $i++) {
            $model = new AirplaneModel();
            $nameLetter = $this->getRandomLetterFromString($alphabet, true);
            $nameNumber = $faker->randomNumber(3, true);
            $model->setName($nameLetter . '-' .  $nameNumber);
            $model->setLength(rand(20, 80));
            $model->setHeight(rand(5, 30));
            $manager->persist($model);
        }

        $manager->flush();
    }

    private function getRandomLetterFromString(string $string, bool $upperCase = false) {
        $ret = substr($string, rand(0, strlen($string) - 1), 1);
        if($upperCase)
            $ret = mb_strtoupper($ret);

        return $ret;
    }

    public function getOrder()
    {
        return 4;
    }
}
