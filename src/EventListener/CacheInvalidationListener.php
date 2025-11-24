<?php

namespace App\EventListener;

use App\Service\CacheRedisService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PostRemoveEventArgs;
use Doctrine\ORM\Events;

/**
 * Listener Doctrine pour invalider le cache Redis après chaque opération CRUD.
 * Invalide automatiquement le cache pour les entités modifiées.
 */
#[AsEntityListener(event: Events::postPersist)]
#[AsEntityListener(event: Events::postUpdate)]
#[AsEntityListener(event: Events::postRemove)]
final class CacheInvalidationListener
{
    public function __construct(
        private CacheRedisService $cacheService,
        private EntityManagerInterface $entityManager
    ) {}

    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->invalidateCache($entity);
    }

    public function postUpdate(PostUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->invalidateCache($entity);
    }

    public function postRemove(PostRemoveEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->invalidateCache($entity);
    }

    private function invalidateCache(object $entity): void
    {
        // Pour une invalidation complète à chaque changement, on vide tout le cache
        // Cela garantit que les données sont toujours à jour après une modification
        $this->cacheService->clear();

        // Vider aussi le cache de résultats Doctrine si configuré
        $this->entityManager->getConfiguration()->getResultCache()?->clear();
    }
}
