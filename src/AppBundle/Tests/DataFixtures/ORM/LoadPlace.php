<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Place;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPlace extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Place();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Place.1', $object);
    }

}
