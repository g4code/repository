<?php

namespace G4\Repository;

class RepositoryIdentity
{

    private $serviceName;
    private $queryParams;

    public function __construct($serviceName, array $queryParams = null)
    {
        $this->serviceName = $serviceName;
        $this->queryParams = $queryParams;
    }

    public function getQueryParams()
    {
        return $this->queryParams === null
            ? []
            : $this->queryParams;
    }

    public function getServiceName()
    {
        return $this->serviceName;
    }
         // todo add site
    public function getCacheKey()
    {
        return  $this->getServiceName() .'|'. md5(serialize($this->getQueryParams()));
    }

}