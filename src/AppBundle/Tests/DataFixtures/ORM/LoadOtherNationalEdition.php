<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\OtherNationalEdition;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadOtherNationalEdition extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new OtherNationalEdition();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('OtherNationalEdition.1', $object);
    }

}
