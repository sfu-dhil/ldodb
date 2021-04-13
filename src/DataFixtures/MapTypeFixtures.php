<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\MapType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MapTypeFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
        $object = new MapType();
        $object->setMapType('chum');
        $object->setMapTypeNotes('Map of chum.');
        $em->persist($object);
        $em->flush();
        $this->setReference('MapType.1', $object);
    }
}
