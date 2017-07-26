<?php

namespace G4\Repository;

use G4\DataMapper\Common\MapperInterface;
use G4\IdentityMap\IdentityMap;
use G4\Repository\Exception\MissingStorageException;
use G4\Repository\Exception\NotValidStorageException;
use G4\RussianDoll\RussianDoll;

class StorageContainer
{

    /**
     * @var IdentityMap
     */
    private $identityMap;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @var RussianDoll
     */
    private $russianDoll;

    /**
     * StorageContainer constructor.
     * @param array $storages
     */
    public function __construct(array $storages)
    {
        if (empty($storages)) {
            throw new MissingStorageException();
        }
        foreach($storages as $aStorage) {
            $this->addStorage($aStorage);
        }
    }

    /**
     * @return IdentityMap
     */
    public function getIdentityMap()
    {
        return $this->identityMap;
    }

    /**
     * @return MapperInterface
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * @return RussianDoll
     */
    public function getRussianDoll()
    {
        return $this->russianDoll;
    }

    /**
     * @param mixed $aStorage
     * @throws NotValidStorageException
     */
    private function addStorage($aStorage)
    {
        if ($aStorage instanceof IdentityMap) {
            $this->identityMap = $aStorage;
            return;
        }
        if ($aStorage instanceof RussianDoll) {
            $this->russianDoll = $aStorage;
            return;
        }
        if ($aStorage instanceof MapperInterface) {
            $this->mapper = $aStorage;
            return;
        }
        throw new NotValidStorageException();
    }
}