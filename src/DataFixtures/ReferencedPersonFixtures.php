<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\ReferencedPerson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReferencedPersonFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
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
