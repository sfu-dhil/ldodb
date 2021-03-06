<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaceFixtures extends Fixture {
    public function load(ObjectManager $em) : void {
        $object = new Place();
        $object->setPlaceName('Piscataria');
        $object->setPlaceUri('http://example.com/place/piscataria');
        $object->setRegionId(2);
        $object->setCountryId(3);
        $object->setLatitude(12);
        $object->setLongitude(12.3);
        $object->setInLakeDistrict(false);
        $em->persist($object);
        $this->setReference('Place.1', $object);

        $object = new Place();
        $object->setPlaceName('Fishibrunswick');
        $object->setPlaceUri('http://example.com/place/fishibrunswick');
        $object->setRegionId(3);
        $object->setCountryId(4);
        $object->setLatitude(1);
        $object->setLongitude(2.3);
        $object->setInLakeDistrict(false);
        $em->persist($object);
        $this->setReference('Place.2', $object);

        $object = new Place();
        $object->setPlaceName('Shrimptown');
        $object->setPlaceUri('http://example.com/place/shrimptown');
        $object->setRegionId(1);
        $object->setCountryId(2);
        $object->setLatitude(120);
        $object->setLongitude(1.3);
        $object->setInLakeDistrict(false);
        $em->persist($object);
        $this->setReference('Place.3', $object);

        $object = new Place();
        $object->setPlaceName('Salmonbrook');
        $object->setPlaceUri('http://example.com/place/salmonbrook');
        $object->setRegionId(1);
        $object->setCountryId(1);
        $object->setLatitude(10);
        $object->setLongitude(20.3);
        $object->setInLakeDistrict(false);
        $em->persist($object);
        $this->setReference('Place.4', $object);

        $em->flush();
    }
}
