<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\BindingFeature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBindingFeature extends Fixture {

    public function load(ObjectManager $em) {
        $object = new BindingFeature();
        $object->setBindingFeature('chicanery');
        $em->persist($object);
        $em->flush();
        $this->setReference('BindingFeature.1', $object);
    }

}
