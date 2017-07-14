<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\MapType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMapType extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new MapType();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('MapType.1', $object);
    }

}
