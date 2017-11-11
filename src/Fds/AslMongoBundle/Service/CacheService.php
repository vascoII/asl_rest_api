<?php

namespace Fds\AslMongoBundle\Service;

use Doctrine\Common\Cache\ArrayCache;

/**
 * Cache Service.
 */
class CacheService
{
    public function clearCache()
    {
        $cacheDriver = new ArrayCache();
        $cacheDriver->deleteAll();
    }
}