<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\ReferencedPerson;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadReferencedPerson extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new ReferencedPerson();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('ReferencedPerson.1', $object);
    }

}
