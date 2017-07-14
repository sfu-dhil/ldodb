<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\PlateType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPlateType extends AbstractFixture {
    
    public function load(ObjectManager $em) {
        $object = new PlateType();
        $object->setPlateType('Bunny');
        $object->setPlateTypeNotes('Plate of a bunny.');
        $em->persist($object);
        $em->flush();
        $this->setReference('PlateType.1', $object);
    }

}
