<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\SubjectHeading;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSubjectHeading extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new SubjectHeading();
        $object->setSubjectHeading('Fish -- Other');
        $object->setSubjectHeadingUri('http://example.com/subject/fish-other');
        $em->persist($object);
        $em->flush();
        $this->setReference('SubjectHeading.1', $object);
    }

}
