<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRole extends Fixture {

    public function load(ObjectManager $em) {
        $object = new Role();
        $object->setRoleName('fishmonger');
        $em->persist($object);
        $em->flush();
        $this->setReference('Role.1', $object);
    }

}
