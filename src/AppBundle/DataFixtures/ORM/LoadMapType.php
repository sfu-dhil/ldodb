<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\MapType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMapType extends Fixture {

    public function load(ObjectManager $em) {
        $object = new MapType();
        $object->setMapType('chum');
        $object->setMapTypeNotes('Map of chum.');
        $em->persist($object);
        $em->flush();
        $this->setReference('MapType.1', $object);
    }

}
