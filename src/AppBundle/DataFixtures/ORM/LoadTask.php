<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTask extends Fixture {

    public function load(ObjectManager $em) {
        $object = new Task();
        $object->setTaskName('Cromulator');
        $em->persist($object);
        $em->flush();
        $this->setReference('Task.1', $object);
    }

}
