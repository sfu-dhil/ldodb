<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\SupplementalPlaceData;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSupplementalPlaceData extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new SupplementalPlaceData();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('SupplementalPlaceData.1', $object);
    }

}
