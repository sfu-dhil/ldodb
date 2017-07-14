<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Entity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEntity extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Entity();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Entity.1', $object);
    }

}
