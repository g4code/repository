<?php

namespace G4\Repository\Adapters;

use App\DI;
use G4\Constants\CacheLifetime;
use G4\Repository\PersistentPriority;
use G4\Repository\RepositoryIdentity;

class Cache implements AdapterInterface
{
    /** @var \G4\Mcache\Mcache */
    private $mcache;

    /** @var RepositoryIdentity */
    private $identity;

    /** @var int */
    private $lifeTime;

    /**
     * Cache constructor.
     * @param \G4\Mcache\Mcache $mcacheInstance
     * @param RepositoryIdentity $identity
     * @param int $lifeTime
     */
    public function __construct(
        \G4\Mcache\Mcache $mcacheInstance,
        RepositoryIdentity $identity,
        $lifeTime = CacheLifetime::LIFETIME_S
    ) {
        $this->mcache = $mcacheInstance;
        // should be generated with domain, service name and params
        $this->identity      = $identity;
        $this->lifeTime = $lifeTime;
    }

    /**
     * @return bool
     */
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

    /**
     * @return mixed
     */
    public function get()
    {
        return  $this->mcache
            ->key($this->identity->getCacheKey())
            ->get();
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return PersistentPriority::MEDIUM;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function post($data = [])
    {
        if (!empty($data)) {
            $this->mcache
                ->key($this->identity->getCacheKey())
                ->value($data)
                ->expiration($this->lifeTime)
                ->set();
        }

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function put($data = [])
    {
        $this->post($data);

        return $this;
    }


}