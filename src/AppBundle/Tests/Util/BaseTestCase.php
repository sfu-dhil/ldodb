<?php

namespace AppBundle\Tests\Util;

use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use ReflectionObject;

class BaseTestCase extends WebTestCase {

    /**
     * @var EntityManager
     */
    protected $em;
    
    protected $container;
    
    public function setUp() {
        parent::setUp();
        self::bootKernel();
        $this->container = static::$kernel->getContainer();
        
        $this->em = $this->container->get('doctrine')->getManager();
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
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
