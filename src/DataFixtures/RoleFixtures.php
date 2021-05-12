<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture {
    public function load(ObjectManager $em) : void {
        $object = new Role();
        $object->setRoleName('fishmonger');
        $em->persist($object);
        $em->flush();
        $this->setReference('Role.1', $object);
    }
}
