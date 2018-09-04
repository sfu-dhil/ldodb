<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\DigitalCopyHolder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDigitalCopyHolder extends Fixture {

    public function load(ObjectManager $em) {
        $object = new DigitalCopyHolder();
        $object->setOrganizationName('Happy Sirens Fishing');
        $em->persist($object);
        $em->flush();
        $this->setReference('DigitalCopyHolder.1', $object);
    }

}
