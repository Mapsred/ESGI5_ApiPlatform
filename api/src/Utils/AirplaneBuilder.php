<?php

namespace App\Utils;

use App\Entity\Airplane;
use App\Entity\Pilot;
use App\Entity\Staff;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AirplaneBuilder
 * @package App\Utils
 */
class AirplaneBuilder
{
    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    /**
     * AirplaneBuilder constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Airplane $airplane
     */
    public function build(Airplane $airplane)
    {
        $this->findOrCreatePilot($airplane);
        $this->buildStaff($airplane);

        $this->manager->flush();
    }

    /**
     * @param Airplane $airplane
     */
    private function findOrCreatePilot(Airplane $airplane)
    {
        if (null === $pilot = $this->manager->getRepository(Pilot::class)->findOneBy(['airplane' => null])) {
            $pilot = new Pilot();
            $pilot->setName(sprintf('AutoPilot %s', rand(0, 1000)));
        }

        $pilot->setAirplane($airplane);
        $this->manager->persist($pilot);
    }

    /**
     * @param Airplane $airplane
     */
    private function buildStaff(Airplane $airplane)
    {
        for ($i = 0; $i < rand(1, 5); $i++) {
            $staff = new Staff();
            $staff->setAirplane($airplane);
            $this->manager->persist($staff);
        }
    }
}
