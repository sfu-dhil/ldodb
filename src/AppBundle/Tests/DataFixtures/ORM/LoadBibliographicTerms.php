<?php

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\BibliographicTerms;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBibliographicTerms extends AbstractFixture {

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
