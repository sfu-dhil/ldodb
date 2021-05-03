<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\PlateType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlateTypeFixtures extends Fixture {
    public function load(ObjectManager $em) : void {
        $object = new PlateType();
        $object->setPlateType('Bunny');
        $object->setPlateTypeNotes('Plate of a bunny.');
        $em->persist($object);
        $em->flush();
        $this->setReference('PlateType.1', $object);
    }
}
