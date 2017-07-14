<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\PlateType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPlateType extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new PlateType();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('PlateType.1', $object);
    }

}
