<?php

use G4\Repository\Repository;
use G4\Repository\RepositoryFactory;
use G4\Repository\Exception\MissingStorageException;
use G4\Repository\Exception\NotValidStorageException;

class RepositoryFactoryTest extends PHPUnit_Framework_TestCase
{


    public function testMissingStorageException()
    {
        $this->expectException(MissingStorageException::class);
        new RepositoryFactory();
    }

    public function testNotValidStorageException()
    {
        $stub = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expectException(NotValidStorageException::class);
        new RepositoryFactory($stub);
    }
}