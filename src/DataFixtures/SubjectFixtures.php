<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
        $object = new Subject();
        $object->setSubjectName('fishies');
        $object->setSubjectUri('http://example.com/subject/fishies');
        $em->persist($object);
        $em->flush();
        $this->setReference('Subject.1', $object);
    }
}
