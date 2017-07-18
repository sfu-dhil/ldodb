<?php

namespace AppBundle\Tests\Util;

use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use ReflectionObject;
use Symfony\Component\DependencyInjection\Container;

class BaseTestCase extends WebTestCase {

    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var Container
     */
    protected $container;
    
    /**
     * @var ReferenceRepository 
     */
    protected $fixtures;
    
    protected function getFixtures() {
        return array();
    }
    
    public function setUp() {
        parent::setUp();
        self::bootKernel();
        $this->container = static::$kernel->getContainer();        
        $this->em = $this->container->get('doctrine')->getManager();
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        
        $this->fixtures = $this->loadFixtures($this->getFixtures())->getReferenceRepository();
        
    }

    public function tearDown() {
        parent::tearDown();
        $this->container = null;
        $this->em->clear();
        $this->em->close();
        $this->em = null;
        
        $refl = new ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        static::$kernel->shutdown();
        gc_collect_cycles();
    }

}
