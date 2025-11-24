<?php

namespace App\EventListener;

use App\Entity\Filiere;
use App\Entity\Parc;
use App\Entity\Segment;
use App\Service\CacheRedisService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostRemoveEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;

/**
 * Listener Doctrine pour invalider le cache Redis après chaque opération CRUD.
 * Invalide automatiquement le cache pour les entités modifiées.
 */
#[AsEntityListener(event: Events::postPersist, entity: Filiere::class)]
#[AsEntityListener(event: Events::postUpdate, entity: Filiere::class)]
#[AsEntityListener(event: Events::postRemove, entity: Filiere::class)]
#[AsEntityListener(event: Events::postPersist, entity: Segment::class)]
#[AsEntityListener(event: Events::postUpdate, entity: Segment::class)]
#[AsEntityListener(event: Events::postRemove, entity: Segment::class)]
#[AsEntityListener(event: Events::postPersist, entity: Parc::class)]
#[AsEntityListener(event: Events::postUpdate, entity: Parc::class)]
#[AsEntityListener(event: Events::postRemove, entity: Parc::class)]
final class CacheInvalidationListener
{
    public function __construct(private CacheRedisService $cacheService) {}

    public function postPersist(PostPersistEventArgs $args): void
    {
        $this->invalidateCache($args->getObject());
    }

    public function postUpdate(PostUpdateEventArgs $args): void
    {
        $this->invalidateCache($args->getObject());
    }

    public function postRemove(PostRemoveEventArgs $args): void
    {
        $this->invalidateCache($args->getObject());
    }

    private function invalidateCache(object $entity): void
    {
        if ($entity instanceof Filiere) {
            $this->cacheService->invalidate([
                "filiere:{$entity->getId()}",
                'filieres:all',
                "parc:{$entity->getParc()?->getId()}:filieres",
            ]);
        } elseif ($entity instanceof Segment) {
            $this->cacheService->invalidate([
                "segment:{$entity->getId()}",
                'segments:all',
                "filiere:{$entity->getFiliere()?->getId()}:segments",
            ]);
        } elseif ($entity instanceof Parc) {
            $this->cacheService->invalidate([
                "parc:{$entity->getId()}",
                'parcs:all',
                'parcs:cache',
            ]);
        }
    }
}
