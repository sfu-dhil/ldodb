<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\ReferencedPlace;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadReferencedPlace extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new ReferencedPlace();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('ReferencedPlace.1', $object);
    }

}
