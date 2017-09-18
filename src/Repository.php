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

    public function read(QueryInterface $query)
    {
        // IdentityMap::has -> IdentityMap::get

        // RussianDoll::fetch -> IdentityMap::set

        // DataMapper::find -> RussianDoll::write && IdentityMap::set

    }

    public function write()
    {
        // DataMapper::update

        // RussianDoll::expire

        // IdentityMap::delete
    }



}