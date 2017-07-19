<?php

namespace G4\Repository;

use G4\Gateway\Http;
use G4\Mcache\Mcache;
use G4\Repository\Exception\MissingStorageException;

class RepositoryFactory
{



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

    }
}