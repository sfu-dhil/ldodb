<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\People;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PeopleFixtures extends Fixture implements DependentFixtureInterface {
    public function getDependencies() {
        return [
            PlaceFixtures::class,
            RoleFixtures::class,
        ];
    }

    public function load(ObjectManager $em) : void {
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
