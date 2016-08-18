<?php

namespace G4\Repository\Adapters;

use App\DI;
use G4\Constants\CacheLifetime;
use G4\Repository\PersistentPriority;
use G4\Repository\RepositoryIdentity;

class Cache implements AdapterInterface
{
    private $mcache;
    private $identity;
    private $lifeTime;

    public function __construct(\G4\Mcache\Mcache $mcacheInstance, RepositoryIdentity $identity, $lifeTime = CacheLifetime::LIFETIME_S)
    {
        $this->mcache = $mcacheInstance;
        // should be generated with domain, service name and params
        $this->identity      = $identity;
        $this->lifeTime = $lifeTime;
    }

    public function has()
    {
        $response = $this->get();
        return !empty($response);
    }

    public function delete()
    {
        $this->mcache
            ->key($this->identity->getCacheKey())
            ->value(null)
            ->expiration($this->lifeTime)
            ->set();
    }

    public function get()
    {
        return  $this->mcache
            ->key($this->identity->getCacheKey())
            ->get();
    }

    public function getPriority()
    {
        return PersistentPriority::MEDIUM;
    }

    public function post($data = [])
    {
        if(!empty($data)){
            $this->mcache
                ->key($this->identity->getCacheKey())
                ->value($data)
                ->expiration($this->lifeTime)
                ->set();
        }
        return $this;
    }

    public function put($data = [])
    {
        $this->post($data);
        return $this;
    }


}