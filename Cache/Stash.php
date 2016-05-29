<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

use Tedivm\StashBundle\Service\CacheService;

/**
 * Class Stash
 * @package Netgen\Bundle\OpenWeatherMapBundle\Cache
 */
class Stash implements HandlerInterface
{
    /**
     * @var \Tedivm\StashBundle\Service\CacheService
     */
    protected $cacheService;

    /**
     * Stash constructor.
     *
     * @param \Tedivm\StashBundle\Service\CacheService $cacheService
     */
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * @inheritDoc
     */
    public function has($cacheKey)
    {
        $cacheKey = self::CACHE_KEY_PREFIX . $cacheKey;

        $item = $this->cacheService->getItem($cacheKey);

        if (!$item->isMiss()) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function get($cacheKey)
    {
        $cacheKey = self::CACHE_KEY_PREFIX . $cacheKey;

        $item = $this->cacheService->getItem($cacheKey);

        if (!$item->isMiss()) {
            return $item->get();
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function set($cacheKey, $data, $ttl)
    {
        $cacheKey = self::CACHE_KEY_PREFIX . $cacheKey;

        $item = $this->cacheService->getItem($cacheKey);

        if (!$item->isMiss()) {
            $item->set($data, $ttl);
        }
    }
}