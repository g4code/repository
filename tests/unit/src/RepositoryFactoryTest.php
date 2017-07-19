<?php

use G4\Repository\RepositoryFactory;
use G4\Repository\Exception\MissingStorageException;

class RepositoryFactoryTest extends PHPUnit_Framework_TestCase
{


    public function testMissingStorageException()
    {
        $this->expectException(MissingStorageException::class);
        new RepositoryFactory();
    }
}