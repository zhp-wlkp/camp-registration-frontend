<?php

namespace App\CampRegistrationSystem\Impl;

use App\CampRegistrationSystem\Camp;
use App\CampRegistrationSystem\CampFinderInterface;
use App\CampRegistrationSystem\CampId;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

#[AsDecorator(decorates: CampFinder::class)]
class CachedCampFinderDecorator implements CampFinderInterface
{
    private CacheInterface $cache;
    public function __construct(private CampFinderInterface $decorated)
    {
    }

    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function findCamp(CampId $id): ?Camp
    {
        return $this->cache->get('camp-'.$id, function (ItemInterface $item) use ($id) {
            $item->expiresAfter(24*60*60);
            return $this->decorated->findCamp($id);
        });
    }
}
