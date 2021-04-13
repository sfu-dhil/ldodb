<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Keyword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class KeywordFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
        $object = new Keyword();
        $object->setKeyword('placodermi');
        $em->persist($object);
        $em->flush();
        $this->setReference('Keyword.1', $object);
    }
}
