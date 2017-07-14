<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\OtherNationalEdition;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadOtherNationalEdition extends AbstractFixture implements DependentFixtureInterface { 

    public function getDependencies() {
        return [
            LoadPlace::class,
            LoadBook::class,
        ];
    }

    public function load(ObjectManager $em) {
        $object = new OtherNationalEdition();
        $object->setBook($this->getReference('Book.1'));
        $object->setPlace($this->getReference('Place.1'));
        $object->setPublicationDate('1098');
        $em->persist($object);
        $em->flush();
        $this->setReference('OtherNationalEdition.1', $object);
    }

}
