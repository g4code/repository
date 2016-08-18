<?php

namespace G4\Repository\Adapters;

use App\DI;
use G4\Gateway\Http;
use G4\Constants\Parameters;
use G4\Repository\PersistentPriority;
use G4\Repository\RepositoryIdentity;

class Gateway implements AdapterInterface
{
    private $identity;
    private $http;


    public function __construct(\G4\Gateway\Http $http,  RepositoryIdentity $identity)
    {
        $this->identity = $identity;
        $this->http = $http;
    }

    public function delete()
    {
        $response = $this->getHttp()
            ->delete($this->identity->getQueryParams());
        if (!$response->isSuccess()) {
            $this->throwError($response);
        }
        return $response->getResource('response');
    }

    public function has()
    {
        return true;
    }

    public function get()
    {
        $response = $this->getHttp()
            ->get($this->identity->getQueryParams());
        if (!$response->isSuccess()) {
            $this->throwError($response);
        }
        return $response->getResource('response');
    }

    public function getPriority()
    {
        return PersistentPriority::LOW;
    }

    public function post($data = [])
    {
        $response = $this->getHttp()
            ->post($data);
        if (!$response->isSuccess()) {
            $this->throwError($response);
        }
        return $response->getResource('response');
    }

    public function put($data = [])
    {
        $response = $this->getHttp()
            ->put($data);
        if (!$response->isSuccess()) {
            $this->throwError($response);
        }
        return $response->getResource('response');
    }

    /**
     * @return \G4\Gateway\Http
     */
    public function getHttp()
    {
        return $this->http
            ->setServiceName($this->identity->getServiceName());
    }

    private function throwError($response)
    {
        throw new \Exception($response->getResource('response')['error']['message'], $response->getCode());
    }

}