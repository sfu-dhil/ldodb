<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PlateType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPlateType extends Fixture {

    public function load(ObjectManager $em) {
        $object = new PlateType();
        $object->setPlateType('Bunny');
        $object->setPlateTypeNotes('Plate of a bunny.');
        $em->persist($object);
        $em->flush();
        $this->setReference('PlateType.1', $object);
    }

}
