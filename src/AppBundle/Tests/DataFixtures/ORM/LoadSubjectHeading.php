<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\SubjectHeading;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSubjectHeading extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new SubjectHeading();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('SubjectHeading.1', $object);
    }

}
