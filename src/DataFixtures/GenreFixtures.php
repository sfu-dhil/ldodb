<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $em) : void {
        $object = new Genre();
        $object->setGenreName('extinct');
        $object->setGenreSource('phylogenic studies');
        $object->setGenreUri('http://example.com/genre/extinct');
        $object->setGenreUsageNote('Not to be used with Dunkleosteus because they rock.');
        $em->persist($object);
        $em->flush();
        $this->setReference('Genre.1', $object);
    }
}
