<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\People;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPeople extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new People();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('People.1', $object);
    }

}
