<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\MapSize;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMapSize extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new MapSize();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('MapSize.1', $object);
    }

}
