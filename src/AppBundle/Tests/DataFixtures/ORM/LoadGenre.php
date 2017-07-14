<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Genre;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGenre extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Genre();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Genre.1', $object);
    }

}
