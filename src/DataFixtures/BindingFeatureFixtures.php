<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\BindingFeature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BindingFeatureFixtures extends Fixture {
    public function load(ObjectManager $em) : void {
        $object = new BindingFeature();
        $object->setBindingFeature('chicanery');
        $em->persist($object);
        $em->flush();
        $this->setReference('BindingFeature.1', $object);
    }
}
