<?php
// src/EventListener/ParcCacheInvalidator.php

namespace App\EventListener;

use App\Entity\Parc;
use App\Entity\Filiere;
use App\Entity\Corde;
use App\Entity\Stock;
use App\Entity\Lanterne;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::postPersist)]
#[AsEntityListener(event: Events::postUpdate)]
#[AsEntityListener(event: Events::postRemove)]
class ParcCacheInvalidator
{
    public function __construct(private ParcCacheService $parcCacheService) {}

    public function __invoke($entity): void
    {
        if (
            $entity instanceof Parc ||
            $entity instanceof Filiere ||
            $entity instanceof Corde ||
            $entity instanceof Stock ||
            $entity instanceof Lanterne
        ) {
            $this->parcCacheService->refreshCache();
        }
    }
}
