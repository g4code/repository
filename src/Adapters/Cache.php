<?php

namespace G4\Repository\Adapters;

use App\DI;
use G4\Mcache\Mcache;
use G4\Constants\CacheLifetime;
use G4\Repository\PersistentPriority;
use G4\Repository\RepositoryIdentity;

class Cache implements AdapterInterface
{

    /** @var Mcache */
    private $mcache;

    /** @var RepositoryIdentity */
    private $identity;

    /** @var int */
    private $lifeTime;

    private $data;

    /** @var  bool */
    private $cacheKeyMissing;

    /**
     * Cache constructor.
     * @param Mcache $mcacheInstance
     * @param RepositoryIdentity $identity
     * @param int $lifeTime
     */
    public function __construct(
        Mcache $mcacheInstance,
        RepositoryIdentity $identity,
        $lifeTime = CacheLifetime::LIFETIME_S
    ) {
        $this->mcache = $mcacheInstance;
        // should be generated with domain, service name and params
        $this->identity = $identity;
        $this->lifeTime = $lifeTime;
    }

    /**
     * @return bool
     */
    public function has()
    {
        $response = false;

        if (!$this->cacheKeyMissing) {
            $response = $this->get();
        }

        return !empty($response);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        if (empty($this->data)) {
            $this->data = $this->mcache
                ->key($this->identity->getCacheKey())
                ->get();
        }

        if ($this->data === false) {
            $this->cacheKeyMissing = true;
        }

        return $this->data;
    }

    public function delete()
    {
        $this->mcache
            ->key($this->identity->getCacheKey())
            ->value(null)
            ->expiration($this->lifeTime)
            ->set();

        $this->data = null;
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

        $this->cacheKeyMissing = false;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return PersistentPriority::MEDIUM;
    }

}