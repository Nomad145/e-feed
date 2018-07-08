<?php

namespace App\Repository;

use GuzzleHttp\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use App\Feed;

/**
 * @author Michael Phillips <michael.phillips@realpage.com>
 */
class FeedRepository
{
    /** @var ClientInterface */
    private $client;

    /** @var array */
    private $feeds;

    public function __construct(ClientInterface $client, array $feeds)
    {
        $this->client = $client;
        $this->feeds = $feeds;
    }

    public function findAll(): array
    {
        $feeds = array_map([$this, 'fetchFeed'], $this->feeds);

        return $feeds;
    }

    public function findOneByUrl(string $url): ?Feed
    {
        $feed = array_filter(
            $this->feeds,
            function (string $feed) use ($url) {
                return (bool) strstr($feed, $url);
            }
        );

        return $this->fetchFeed(array_pop($feed));
    }

    private function fetchFeed(string $feedUrl)
    {
        $response = $this->client->get($feedUrl);

        $xmlFeed = (string) $response->getBody();

        return new Feed($xmlFeed);
    }
}
