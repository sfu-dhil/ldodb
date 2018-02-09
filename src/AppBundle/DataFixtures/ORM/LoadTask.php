<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTask extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new Task();
        $object->setTaskName('Cromulator');
        $em->persist($object);
        $em->flush();
        $this->setReference('Task.1', $object);
    }

}
