<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSubject extends Fixture {

    public function load(ObjectManager $em) {
        $object = new Subject();
        $object->setSubjectName('fishies');
        $object->setSubjectUri('http://example.com/subject/fishies');
        $em->persist($object);
        $em->flush();
        $this->setReference('Subject.1', $object);
    }

}
