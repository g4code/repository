<?php

namespace G4\Repository\Adapters;

use G4\Repository\PersistentPriority;
use G4\Repository\RepositoryIdentity;

class Memory implements AdapterInterface
{
    private $identity;

    private $identityMap;

    public function __construct(\G4\IdentityMap\IdentityMap $identityMap, RepositoryIdentity $identity)
    {
        $this->identity    = $identity;
        $this->identityMap = $identityMap;
    }

    public function delete()
    {
        return $this->identityMap->set($this->identity->getCacheKey(), null);
    }

    public function get()
    {
        return $this->identityMap->get($this->identity->getCacheKey());
    }

    public function getPriority()
    {
        return PersistentPriority::HEIGH;
    }

    public function has()
    {
        return $this->identityMap->has($this->identity->getCacheKey());
    }

    public function put($data = [])
    {
        return $this->identityMap->set($this->identity->getCacheKey(), $data);
    }

    public function post($data = [])
    {
        return $this->identityMap->set($this->identity->getCacheKey(), $data);
    }
}
