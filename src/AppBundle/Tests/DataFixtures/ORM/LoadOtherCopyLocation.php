<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\OtherCopyLocation;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadOtherCopyLocation extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new OtherCopyLocation();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('OtherCopyLocation.1', $object);
    }

}
