<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Contribution;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadContribution extends AbstractFixture implements DependentFixtureInterface { 

    public function getDependencies() {
        return [
            LoadBook::class,
            LoadOrganization::class,
            LoadPeople::class,
            LoadTask::class,
        ];
    }

    public function load(ObjectManager $em) {
        $object = new Contribution();
        $object->setBook($this->getReference('Book.1'));
        $object->setEntity($this->getReference('Person.1'));
        $object->setTask($this->getReference('Task.1'));        
        $em->persist($object);
        $this->setReference('Contribution.1', $object);
        
        $object = new Contribution();
        $object->setBook($this->getReference('Book.1'));
        $object->setEntity($this->getReference('Organization.1'));
        $object->setTask($this->getReference('Task.1'));        
        $em->persist($object);
        $this->setReference('Contribution.2', $object);
        $em->flush();
    }

}
