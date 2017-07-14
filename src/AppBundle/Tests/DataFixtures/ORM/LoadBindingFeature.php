<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\BindingFeature;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBindingFeature extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new BindingFeature();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('BindingFeature.1', $object);
    }

}
