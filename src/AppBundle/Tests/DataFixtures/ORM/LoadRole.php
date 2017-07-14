<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRole extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Role();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Role.1', $object);
    }

}
