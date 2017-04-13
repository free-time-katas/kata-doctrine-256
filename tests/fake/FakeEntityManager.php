<?php

namespace diaz\david\tests\fake;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

/**
 * Class FakeEntityManager
 * @package diaz\david\tests\fake
 */
class FakeEntityManager extends EntityManager
{
    /** @var bool */
    private $_throwException;

    /**
     * FakeEntityManager constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $connection = DriverManager::getConnection(
            ['url' => 'sqlite:///:memory:'], $configuration, new EventManager()
        );
        parent::__construct($connection, $configuration, $connection->getEventManager());
    }

    /**
     * @param bool $throwException
     */
    public function setThrowException(bool $throwException)
    {
        $this->_throwException = $throwException;
    }

    /**
     * @param object $entity
     * @throws \Exception
     */
    public function persist($entity)
    {
        if ($this->_throwException) {
            throw new \Exception();
        }
        parent::persist($entity);
    }


}