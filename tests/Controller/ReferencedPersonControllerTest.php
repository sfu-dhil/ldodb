<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tests\Controller;

use App\DataFixtures\ReferencedPersonFixtures;
use App\Entity\ReferencedPerson;
use Nines\UserBundle\DataFixtures\UserFixtures;
use Nines\UtilBundle\Tests\ControllerBaseCase;

class ReferencedPersonControllerTest extends ControllerBaseCase {
    protected function fixtures() : array {
        return [
            UserFixtures::class,
            ReferencedPersonFixtures::class,
        ];
    }

    public function testAnonIndex() : void {
        $crawler = $this->client->request('GET', '/referenced_person/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('New')->count());
    }

    public function testUserIndex() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_person/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('New')->count());
    }

    public function testAdminIndex() : void {
        $this->login('user.admin');
        $crawler = $this->client->request('GET', '/referenced_person/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->selectLink('New')->count());
    }

    public function testAnonShow() : void {
        $crawler = $this->client->request('GET', '/referenced_person/1');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('Edit')->count());
        $this->assertSame(0, $crawler->selectLink('Delete')->count());
    }

    public function testUserShow() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_person/1');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('Edit')->count());
        $this->assertSame(0, $crawler->selectLink('Delete')->count());
    }

    public function testAdminShow() : void {
        $this->login('user.admin');
        $crawler = $this->client->request('GET', '/referenced_person/1');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->selectLink('Edit')->count());
        $this->assertSame(1, $crawler->selectLink('Delete')->count());
    }

    public function testAnonEdit() : void {
        $crawler = $this->client->request('GET', '/referenced_person/1/edit');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserEdit() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_person/1/edit');
        $this->assertSame(403, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminEdit() : void {
        $this->login('user.admin');
        $formCrawler = $this->client->request('GET', '/referenced_person/1/edit');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $form = $formCrawler->selectButton('Update')->form([
            'referenced_person[lastName]' => 'Fish',
            'referenced_person[firstName]' => 'Jim',
            'referenced_person[birthDate]' => '1927',
            'referenced_person[deathDate]' => '1927',
        ]);

        $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect('/referenced_person/1'));
        $responseCrawler = $this->client->followRedirect();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $responseCrawler->filter('td:contains("Fish")')->count());
        $this->assertSame(1, $responseCrawler->filter('td:contains("Jim")')->count());
        $this->assertSame(2, $responseCrawler->filter('td:contains("1927")')->count());
    }

    public function testAnonNew() : void {
        $crawler = $this->client->request('GET', '/referenced_person/new');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserNew() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_person/new');
        $this->assertSame(403, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminNew() : void {
        $this->login('user.admin');
        $formCrawler = $this->client->request('GET', '/referenced_person/new');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $form = $formCrawler->selectButton('Create')->form([
            'referenced_person[lastName]' => 'Fish',
            'referenced_person[firstName]' => 'Jim',
            'referenced_person[birthDate]' => '1927',
            'referenced_person[deathDate]' => '1927',
        ]);

        $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $responseCrawler = $this->client->followRedirect();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $responseCrawler->filter('td:contains("Fish")')->count());
        $this->assertSame(1, $responseCrawler->filter('td:contains("Jim")')->count());
        $this->assertSame(2, $responseCrawler->filter('td:contains("1927")')->count());
    }

    public function testAnonDelete() : void {
        $crawler = $this->client->request('GET', '/referenced_person/1/delete');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserDelete() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_person/1/delete');
        $this->assertSame(403, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminDelete() : void {
        $preCount = count($this->entityManager->getRepository(ReferencedPerson::class)->findAll());
        $this->login('user.admin');
        $crawler = $this->client->request('GET', '/referenced_person/1/delete');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $responseCrawler = $this->client->followRedirect();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $this->entityManager->clear();
        $postCount = count($this->entityManager->getRepository(ReferencedPerson::class)->findAll());
        $this->assertSame($preCount - 1, $postCount);
    }
}
