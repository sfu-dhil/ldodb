<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Organization;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadOrganization extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Organization();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Organization.1', $object);
    }

}
