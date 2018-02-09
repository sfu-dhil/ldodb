<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\OtherNationalEdition;
use AppBundle\DataFixtures\ORM\LoadOtherNationalEdition;
use Nines\UtilBundle\Tests\Util\BaseTestCase;
use Nines\UserBundle\DataFixtures\ORM\LoadUser;

class OtherNationalEditionControllerTest extends BaseTestCase
{

    protected function getFixtures() {
        return [
            LoadUser::class,
            LoadOtherNationalEdition::class
        ];
    }
    
    public function testAnonIndex() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/other_national_edition/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->selectLink('New')->count());
    }
    
    public function testUserIndex() {
        $client = $this->makeClient([
            'username' => 'user@example.com',
            'password' => 'secret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->selectLink('New')->count());
    }
    
    public function testAdminIndex() {
        $client = $this->makeClient([
            'username' => 'admin@example.com',
            'password' => 'supersecret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->selectLink('New')->count());
    }
    
    public function testAnonShow() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/other_national_edition/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->selectLink('Edit')->count());
        $this->assertEquals(0, $crawler->selectLink('Delete')->count());
    }
    
    public function testUserShow() {
        $client = $this->makeClient([
            'username' => 'user@example.com',
            'password' => 'secret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->selectLink('Edit')->count());
        $this->assertEquals(0, $crawler->selectLink('Delete')->count());
    }
    
    public function testAdminShow() {
        $client = $this->makeClient([
            'username' => 'admin@example.com',
            'password' => 'supersecret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->selectLink('Edit')->count());
        $this->assertEquals(1, $crawler->selectLink('Delete')->count());
    }
    public function testAnonEdit() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/other_national_edition/1/edit');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }
    
    public function testUserEdit() {
        $client = $this->makeClient([
            'username' => 'user@example.com',
            'password' => 'secret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/1/edit');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
        
    }
    
    public function testAdminEdit() {
        $client = $this->makeClient([
            'username' => 'admin@example.com',
            'password' => 'supersecret',
        ]);
        $formCrawler = $client->request('GET', '/other_national_edition/1/edit');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $form = $formCrawler->selectButton('Update')->form([
            'other_national_edition[publicationDate]' => 1072,
            'other_national_edition[book]' => $this->getReference('Book.1')->getId(),
            'other_national_edition[place]' => $this->getReference('Place.3')->getId(),
        ]);
        
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/other_national_edition/1'));
        $responseCrawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $responseCrawler->filter("td:contains('1072')")->count());
        $this->assertEquals(1, $responseCrawler->filter("td:contains('{$this->getReference('Book.1')}')")->count());
        $this->assertEquals(1, $responseCrawler->filter("td:contains('{$this->getReference('Place.3')}')")->count());
    }
    
    public function testAnonNew() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/other_national_edition/new');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }
    
    public function testUserNew() {
        $client = $this->makeClient([
            'username' => 'user@example.com',
            'password' => 'secret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/new');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
        
    }

    public function testAdminNew() {
        $client = $this->makeClient([
            'username' => 'admin@example.com',
            'password' => 'supersecret',
        ]);
        $formCrawler = $client->request('GET', '/other_national_edition/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $form = $formCrawler->selectButton('Create')->form([
            'other_national_edition[publicationDate]' => 1072,
            'other_national_edition[book]' => $this->getReference('Book.1')->getId(),
            'other_national_edition[place]' => $this->getReference('Place.3')->getId(),
        ]);
        
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $responseCrawler = $client->followRedirect();
        $this->assertEquals(1, $responseCrawler->filter("td:contains('1072')")->count());
        $this->assertEquals(1, $responseCrawler->filter("td:contains('{$this->getReference('Book.1')}')")->count());
        $this->assertEquals(1, $responseCrawler->filter("td:contains('{$this->getReference('Place.3')}')")->count());
    }
    
    public function testAnonDelete() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/other_national_edition/1/delete');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        
    }
    
    public function testUserDelete() {
        $client = $this->makeClient([
            'username' => 'user@example.com',
            'password' => 'secret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/1/delete');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
        
    }

    public function testAdminDelete() {
        self::bootKernel();

        $preCount = count($this->em->getRepository(OtherNationalEdition::class)->findAll());
        $client = $this->makeClient([
            'username' => 'admin@example.com',
            'password' => 'supersecret',
        ]);
        $crawler = $client->request('GET', '/other_national_edition/1/delete');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect());
        $responseCrawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $this->em->clear();
        $postCount = count($this->em->getRepository(OtherNationalEdition::class)->findAll());
        $this->assertEquals($preCount - 1, $postCount);
    }

}
