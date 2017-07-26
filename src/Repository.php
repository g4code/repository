<?php

namespace G4\Repository;


class Repository
{

    /**
     * @var StorageContainer
     */
    private $storageContainer;

    /**
     * Repository constructor.
     * @param StorageContainer $storageContainer
     */
    public function __construct(StorageContainer $storageContainer)
    {
        $this->storageContainer = $storageContainer;
    }

    public function read()
    {

    }

    public function write()
    {

    }



}