<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\Organization;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadOrganization extends AbstractFixture {

    public function load(ObjectManager $em) {
        $object = new Organization();
        $object->setOrganizationName('Fisherwomen Inc.');
        $object->setOrganizationNotes('Group of Fisherwomen in search of Groupers.');
        $object->setOrganizationUri('http://example.com/organization/fisherwomen-inc');            
        $em->persist($object);
        $em->flush();
        $this->setReference('Organization.1', $object);
    }

}
