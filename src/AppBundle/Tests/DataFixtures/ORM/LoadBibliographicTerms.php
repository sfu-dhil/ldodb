<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Tests\DataFixtures\ORM;

use AppBundle\Entity\BibliographicTerms;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of LoadBibliographicTerms
 *
 * @author michael
 */
class LoadBibliographicTerms  extends AbstractFixture implements OrderedFixtureInterface { 

    public function getOrder() {
        1;
    }

    public function load(ObjectManager $em) {
        $bibliographicTerm = new BibliographicTerms();
        $bibliographicTerm->setBibliographicTerm('folio');
        $bibliographicTerm->setUseForFormat(true);
        $bibliographicTerm->setUseForIllustrations(true);
        $bibliographicTerm->setUseForPhotographs(true);
        $em->persist($bibliographicTerm);
        $em->flush();
        $this->setReference('bibliographicTerms.1', $bibliographicTerm);
    }

}
