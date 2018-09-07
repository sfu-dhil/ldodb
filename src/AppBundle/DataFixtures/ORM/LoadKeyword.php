<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Keyword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKeyword extends Fixture {

    public function load(ObjectManager $em) {
        $object = new Keyword();
        $object->setKeyword('placodermi');
        $em->persist($object);
        $em->flush();
        $this->setReference('Keyword.1', $object);
    }

}
