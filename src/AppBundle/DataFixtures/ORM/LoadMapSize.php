<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\MapSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMapSize extends Fixture {

    public function load(ObjectManager $em) {
        $object = new MapSize();
        $object->setMapSize('bigfish');
        $object->setMapSizeNotes('size of a big fish, not a map of big fishes.');
        $em->persist($object);
        $em->flush();
        $this->setReference('MapSize.1', $object);
    }

}
