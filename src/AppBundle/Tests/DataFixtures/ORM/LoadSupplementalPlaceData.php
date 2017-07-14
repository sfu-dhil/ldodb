<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\SupplementalPlaceData;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSupplementalPlaceData extends AbstractFixture {

    public function load(ObjectManager $em) {
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
