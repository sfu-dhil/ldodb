<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\MapType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMapType extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new MapType();
        $object->setMapType('chum');
        $object->setMapTypeNotes('Map of chum.');
        $em->persist($object);
        $em->flush();
        $this->setReference('MapType.1', $object);
    }

}
