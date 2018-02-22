<?php

namespace G4\Repository;

use G4\PredefinedVariables\Server;

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

    public function getCacheKey()
    {
        return  (new Server())->httpHost()
            . '|' . $this->getServiceName()
            . '|' . md5(serialize($this->getQueryParams()));
    }
}
