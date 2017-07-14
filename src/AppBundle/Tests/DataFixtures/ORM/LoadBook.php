<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Book;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBook extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $object = new Book();
        // DO STUFF HERE.
        $em->persist($object);
        $em->flush();
        $this->setReference('Book.1', $object);
    }

}
