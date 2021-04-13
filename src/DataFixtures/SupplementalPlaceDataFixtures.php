<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\SupplementalPlaceData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SupplementalPlaceDataFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
        $object = new SupplementalPlaceData();
        $object->setGeonameId(1);
        $object->setGeoname('Cromwell, Alaska');
        $object->setLatitude('12.0');
        $object->setLongitude('-13.3');
        $em->persist($object);
        $em->flush();
        $this->setReference('SupplementalPlaceData.1', $object);
    }
}
