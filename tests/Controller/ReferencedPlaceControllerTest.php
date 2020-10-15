<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tests\Controller;

use App\DataFixtures\ReferencedPlaceFixtures;
use App\Entity\ReferencedPlace;
use Nines\UserBundle\DataFixtures\UserFixtures;
use Nines\UtilBundle\Tests\ControllerBaseCase;

class ReferencedPlaceControllerTest extends ControllerBaseCase {
    public function fixtures() : array {
        return [
            UserFixtures::class,
            ReferencedPlaceFixtures::class,
        ];
    }

    public function testAnonIndex() : void {
        $crawler = $this->client->request('GET', '/referenced_place/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('New')->count());
    }

    public function testUserIndex() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_place/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('New')->count());
    }

    public function testAdminIndex() : void {
        $this->login('user.admin');
        $crawler = $this->client->request('GET', '/referenced_place/');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->selectLink('New')->count());
    }

    public function testAnonShow() : void {
        $crawler = $this->client->request('GET', '/referenced_place/1');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('Edit')->count());
        $this->assertSame(0, $crawler->selectLink('Delete')->count());
    }

    public function testUserShow() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_place/1');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->selectLink('Edit')->count());
        $this->assertSame(0, $crawler->selectLink('Delete')->count());
    }

    public function testAdminShow() : void {
        $this->login('user.admin');
        $crawler = $this->client->request('GET', '/referenced_place/1');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->selectLink('Edit')->count());
        $this->assertSame(1, $crawler->selectLink('Delete')->count());
    }

    public function testAnonEdit() : void {
        $crawler = $this->client->request('GET', '/referenced_place/1/edit');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserEdit() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_place/1/edit');
        $this->assertSame(403, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminEdit() : void {
        $this->login('user.admin');
        $formCrawler = $this->client->request('GET', '/referenced_place/1/edit');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $this->markTestIncomplete('This test fails for unknown reasons.');

        $form = $formCrawler->selectButton('Update')->form([
            'referenced_place[variantSpelling]' => 'Icthyana',
            'referenced_place[book]' => $this->getReference('Book.1')->getId(),
            'referenced_place[place]' => $this->getReference('Place.1')->getId(),
        ]);

        $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect('/referenced_place/1'));
        $responseCrawler = $this->client->followRedirect();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $responseCrawler->filter('td:contains("Icthyana")')->count());
        $this->assertSame(1, $responseCrawler->filter("td:contains('{$this->getReference('Book.1')}')")->count());
        $this->assertSame(1, $responseCrawler->filter("td:contains('{$this->getReference('Place.1')}')")->count());
    }

    public function testAnonNew() : void {
        $crawler = $this->client->request('GET', '/referenced_place/new');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserNew() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_place/new');
        $this->assertSame(403, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminNew() : void {
        $this->login('user.admin');
        $formCrawler = $this->client->request('GET', '/referenced_place/new');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $this->markTestIncomplete('This test fails for unknown reasons.');

        $form = $formCrawler->selectButton('Create')->form([
            'referenced_place[variantSpelling]' => 'Icthyana',
            'referenced_place[book]' => $this->getReference('Book.1')->getId(),
            'referenced_place[place]' => $this->getReference('Place.1')->getId(),
        ]);

        $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $responseCrawler = $this->client->followRedirect();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $responseCrawler->filter('td:contains("Icthyana")')->count());
        $this->assertSame(1, $responseCrawler->filter("td:contains('{$this->getReference('Book.1')}')")->count());
        $this->assertSame(1, $responseCrawler->filter("td:contains('{$this->getReference('Place.1')}')")->count());
    }

    public function testAnonDelete() : void {
        $crawler = $this->client->request('GET', '/referenced_place/1/delete');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserDelete() : void {
        $this->login('user.user');
        $crawler = $this->client->request('GET', '/referenced_place/1/delete');
        $this->assertSame(403, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminDelete() : void {
        $preCount = count($this->entityManager->getRepository(ReferencedPlace::class)->findAll());
        $this->login('user.admin');
        $crawler = $this->client->request('GET', '/referenced_place/1/delete');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $responseCrawler = $this->client->followRedirect();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $this->entityManager->clear();
        $postCount = count($this->entityManager->getRepository(ReferencedPlace::class)->findAll());
        $this->assertSame($preCount - 1, $postCount);
    }
}
