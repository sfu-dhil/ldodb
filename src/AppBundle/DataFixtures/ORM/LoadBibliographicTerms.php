<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\BibliographicTerms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBibliographicTerms extends Fixture {

    public function load(ObjectManager $em) {
        $object = new BibliographicTerms();
        $object->setBibliographicTerm('fins');
        $object->setUseForFormat(true);
        $object->setUseForIllustrations(true);
        $object->setUseForPhotographs(true);
        $em->persist($object);
        $em->flush();
        $this->setReference('BibliographicTerms.1', $object);
    }

}
