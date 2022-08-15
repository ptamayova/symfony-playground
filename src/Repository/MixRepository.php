<?php

namespace App\Repository;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Returns data about songs
 */
class MixRepository
{
    const DEV_EXPIRATION_SECONDS = 5;
    const PROD_EXPIRATION_SECONDS = 60;
    /**
     * @param CacheInterface $cache
     * @param HttpClientInterface $httpClient
     * @param bool $isDebug
     */
    public function __construct(
        // New syntax to create attributes easier in PHP 8 (it creates and assigns the attributes)
        private CacheInterface $cache,
        private HttpClientInterface $httpClient,
        private bool $isDebug
    ) {}

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function findAll(): array
    {
        return $this->cache->get('mixes_data', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(
                $this->isDebug ?
                        self::DEV_EXPIRATION_SECONDS :
                        self::PROD_EXPIRATION_SECONDS
            );
            $response = $this->httpClient
                ->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });
    }
}