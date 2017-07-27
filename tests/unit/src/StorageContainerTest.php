<?php

use G4\RussianDoll\RussianDoll;
use G4\IdentityMap\IdentityMap;
use G4\DataMapper\Common\MapperInterface;
use G4\Repository\Repository;
use G4\Repository\StorageContainer;
use G4\Repository\Exception\MissingStorageException;
use G4\Repository\Exception\NotValidStorageException;

class StorageContainerTest extends PHPUnit_Framework_TestCase
{


    public function testMissingStorageException()
    {
        $this->expectException(MissingStorageException::class);
        new StorageContainer([]);
    }

    public function testNotValidStorageException()
    {
        $stub = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expectException(NotValidStorageException::class);
        new StorageContainer([$stub]);
    }

    public function testGetters()
    {
        $identityMapStub = $this->getMockBuilder(IdentityMap::class)
            ->disableOriginalConstructor()
            ->getMock();

        $russianDollStub = $this->getMockBuilder(RussianDoll::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mapperStub = $this->getMockBuilder(MapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $storageContainer = new StorageContainer([$russianDollStub, $identityMapStub, $mapperStub]);

        $this->assertEquals($identityMapStub, $storageContainer->getIdentityMap());
        $this->assertEquals($russianDollStub, $storageContainer->getRussianDoll());
        $this->assertEquals($mapperStub, $storageContainer->getDataMapper());

        $this->assertTrue($storageContainer->hasIdentityMap());
        $this->assertTrue($storageContainer->hasRussianDoll());
        $this->assertTrue($storageContainer->hasDataMapper());
    }
}