<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\DigitalCopyHolder;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDigitalCopyHolder extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new DigitalCopyHolder();
        $object->setOrganizationName('Happy Sirens Fishing');
        $em->persist($object);
        $em->flush();
        $this->setReference('DigitalCopyHolder.1', $object);
    }

}
