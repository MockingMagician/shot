<?php

namespace MockingMagician\Shot\Service;


use Psr\SimpleCache\CacheInterface;

interface ServiceRecorder
{
    /**
     * Save the service in cache
     *
     * @param CacheInterface $cache
     */
    public function save(CacheInterface $cache);
}
