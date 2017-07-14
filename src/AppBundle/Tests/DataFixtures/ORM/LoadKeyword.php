<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Keyword;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKeyword extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Keyword();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Keyword.1', $object);
    }

}
