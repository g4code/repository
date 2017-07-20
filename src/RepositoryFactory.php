<?php

namespace G4\Repository;

use G4\Gateway\Http;
use G4\Mcache\Mcache;
use G4\Repository\Exception\MissingStorageException;
use G4\Repository\Exception\NotValidStorageException;

class RepositoryFactory
{

    private $http;

    private $mcache;


    public function __construct(...$storages)
    {
        if (empty($storages)) {
            throw new MissingStorageException();
        }
        $this->reviewStorages($storages);
    }

    public function create()
    {

    }

    private function reviewStorages(array $storages)
    {
        foreach($storages as $aStorage) {
            $this->setOneStorage($aStorage);
        }
    }

    private function setOneStorage($aStorage)
    {
        if ($aStorage instanceof Http) {
            $this->http = $aStorage;
            return;
        }
        if ($aStorage instanceof Mcache) {
            $this->mcache = $aStorage;
            return;
        }
        throw new NotValidStorageException();
    }
}