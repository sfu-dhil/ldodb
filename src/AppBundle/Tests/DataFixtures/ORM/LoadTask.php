<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTask extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Task();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Task.1', $object);
    }

}
