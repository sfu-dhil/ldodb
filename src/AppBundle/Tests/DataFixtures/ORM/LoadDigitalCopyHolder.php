<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\DigitalCopyHolder;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDigitalCopyHolder extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new DigitalCopyHolder();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('DigitalCopyHolder.1', $object);
    }

}
