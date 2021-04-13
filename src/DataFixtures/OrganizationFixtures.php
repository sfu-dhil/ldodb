<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
        $object = new Organization();
        $object->setOrganizationName('Fisherwomen Inc.');
        $object->setOrganizationNotes('Group of Fisherwomen in search of Groupers.');
        $object->setOrganizationUri('http://example.com/organization/fisherwomen-inc');
        $em->persist($object);
        $em->flush();
        $this->setReference('Organization.1', $object);
    }
}
