<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\BindingFeature;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBindingFeature extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new BindingFeature();
        $object->setBindingFeature('chicanery');
        $em->persist($object);
        $em->flush();
        $this->setReference('BindingFeature.1', $object);
    }

}
