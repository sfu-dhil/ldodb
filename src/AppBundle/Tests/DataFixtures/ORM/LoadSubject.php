<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSubject extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Subject();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Subject.1', $object);
    }

}
