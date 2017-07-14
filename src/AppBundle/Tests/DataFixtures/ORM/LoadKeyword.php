<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Keyword;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKeyword extends AbstractFixture {
    
    public function load(ObjectManager $em) {
        $object = new Keyword();
        $object->setKeyword('placodermi');
        $em->persist($object);
        $em->flush();
        $this->setReference('Keyword.1', $object);
    }

}
