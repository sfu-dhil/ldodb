<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\People;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPeople extends AbstractFixture implements DependentFixtureInterface { 

    public function getDependencies() {
        return [
            LoadPlace::class,
            LoadRole::class,
        ];
    }

    public function load(ObjectManager $em) {
        $object = new People();
        $object->setBiographicalAnnotation('biographical annotation.');
        $object->setBiographicalNotes('bio notes');
        $object->setBirthDate('yesterday');
        $object->setBirthPlace($this->getReference('Place.1'));
        $object->setDeathDate('tomorrow');
        $object->setDeathPlace($this->getReference('Place.2'));
        $object->setFirstName('Jim');
        $object->setGender('L');
        $object->setLastName('The Fish');
        $object->setNationality('Oceana');
        $object->setResidentInLd(false);
        $object->setResidentInLondon(true);
        $object->setResidentOutsideUk(true);
        $object->setTravelOutsideUk(true);
        $object->addResidence($this->getReference('Place.1'));
        $object->addResidence($this->getReference('Place.2'));
        $object->addTravel($this->getReference('Place.2'));
        $object->addTravel($this->getReference('Place.3'));        
        $object->addRole($this->getReference('Role.1'));
        $em->persist($object);
        $em->flush();
        $this->setReference('People.1', $object);
    }

}
