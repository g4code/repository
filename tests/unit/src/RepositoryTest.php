<?php

use G4\Repository\Repository;

class RepositoryTest extends \PHPUnit_Framework_TestCase
{


    public function testInstance()
    {
        $storageContainerMock = $this->getMockBuilder(\G4\Repository\StorageContainer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $repository = new Repository($storageContainerMock);
        $this->assertInstanceOf(Repository::class, $repository);
    }
}