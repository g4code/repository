<?php

use G4\Repository\Repository;

class RepositoryTest extends \PHPUnit_Framework_TestCase
{


    public function testInstance()
    {
        $repository = new Repository();
        $this->assertInstanceOf(Repository::class, $repository);
    }
}