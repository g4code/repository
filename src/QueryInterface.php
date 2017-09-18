<?php

namespace G4\Repository;

interface QueryInterface {

    public function getKey();

    public function getService();

    public function getDomainName();

    public function getParams();

    /**
     * @return \G4\DataMapper\Common\IdentityInterface
     */
    public function getIdentity();

}