<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Contribution;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContributionFixtures extends Fixture implements DependentFixtureInterface {
    public function getDependencies() {
        return [
            BookFixtures::class,
            OrganizationFixtures::class,
            PeopleFixtures::class,
            TaskFixtures::class,
        ];
    }

    public function load(ObjectManager $em) : void {
        $object = new Contribution();
        $object->setBook($this->getReference('Book.1'));
        $object->setEntity($this->getReference('People.1'));
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
