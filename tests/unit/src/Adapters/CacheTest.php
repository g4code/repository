<?php

use G4\Repository\Adapters\Cache;

class CacheTest extends PHPUnit_Framework_TestCase
{

    private $mockMcache;
    private $mockIdentity;
    private $lifeTime = 3600;

    public function setUp()
    {
        $this->mockMcache = $this->getMockBuilder(\G4\Mcache\Mcache::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockIdentity = $this->getMockBuilder(\G4\Repository\RepositoryIdentity::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testHasWhenDataIsFetched()
    {
        $this->mockMcache->expects($this->once())->method('key')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('get')->willReturn(['data-item-1', 'data-item-2']);

        $this->assertEquals(
            true,
            $this->getCacheInstance()->has()
        );
    }

    public function testHasWhenDataExists()
    {
        $cacheInstance = $this->getCacheInstance();

        $this->mockMcache->expects($this->once())->method('key')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('get')->willReturn(['data-item']);

        $this->assertEquals(
            true,
            $cacheInstance->has()
        );

        $cacheInstance->has();
        $cacheInstance->has();
    }

    public function testHasWhenDataIsEmptyArray()
    {
        $cacheInstance = $this->getCacheInstance();

        $this->mockMcache->expects($this->once())->method('key')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('get')->willReturn([]);

        $this->assertEquals(
            true,
            $cacheInstance->has()
        );

        $cacheInstance->get();
    }

    public function testHasWhenKeyDoesntExists()
    {
        $cacheInstance = $this->getCacheInstance();

        $this->mockMcache->expects($this->once())->method('key')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('get')->willReturn(false);

        $this->assertEquals(
            false,
            $cacheInstance->has()
        );

        $this->assertEquals(
            false,
            $cacheInstance->has()
        );
    }

    public function testDelete()
    {
        $this->mockMcache->expects($this->once())->method('key')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('value')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('expiration')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('set');

        $this->getCacheInstance()->delete();
    }

    public function testPutWithData()
    {
        $this->mockMcache->expects($this->once())->method('key')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('value')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('expiration')->willReturn($this->mockMcache);
        $this->mockMcache->expects($this->once())->method('set');

        $this->assertInstanceOf(
            Cache::class,
            $this->getCacheInstance()->put('data')
        );
    }

    public function testPutWithoutData()
    {
        $this->mockMcache->expects($this->never())->method('key');
        $this->mockMcache->expects($this->never())->method('value');
        $this->mockMcache->expects($this->never())->method('expiration');
        $this->mockMcache->expects($this->never())->method('set');

        $this->assertInstanceOf(
            Cache::class,
            $this->getCacheInstance()->put()
        );
    }

    public function testGetPriority()
    {
        $this->assertEquals(
            50,
            $this->getCacheInstance()->getPriority()
        );
    }

    private function getCacheInstance()
    {
        return new Cache($this->mockMcache, $this->mockIdentity, $this->lifeTime);
    }

}