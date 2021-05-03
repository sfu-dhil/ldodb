<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\SubjectHeading;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectHeadingFixtures extends Fixture {
    public function load(ObjectManager $em) : void {
        $object = new SubjectHeading();
        $object->setSubjectHeading('Fish -- Other');
        $object->setSubjectHeadingUri('http://example.com/subject/fish-other');
        $em->persist($object);
        $em->flush();
        $this->setReference('SubjectHeading.1', $object);
    }
}
