<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Contribution;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadContribution extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Contribution();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Contribution.1', $object);
    }

}
