<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\ReferencedPerson;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadReferencedPerson extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new ReferencedPerson();
        $object->setLastName('Piscine');
        $object->setFirstName('Betta');
        $object->setBirthDate('Dawn of Time');
        $object->setDeathDate('After that');
        $object->setReferencedPersonUri('http://example.com/person/123');
        $object->setSameAsPeopleEntityId(1); 
        $em->persist($object);
        $em->flush();
        $this->setReference('ReferencedPerson.1', $object);
    }

}
