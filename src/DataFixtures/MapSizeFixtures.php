<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\MapSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MapSizeFixtures extends Fixture {
    public function load(ObjectManager $em) : void {
        $object = new MapSize();
        $object->setMapSize('bigfish');
        $object->setMapSizeNotes('size of a big fish, not a map of big fishes.');
        $em->persist($object);
        $em->flush();
        $this->setReference('MapSize.1', $object);
    }
}
