<?php

namespace App\EventSubscriber;

use App\Entity\Parc;
use App\Entity\Filiere;
use App\Entity\Segment;
use Doctrine\ORM\Events;
use App\Entity\StockCorde;
use App\Entity\Emplacement;
use App\Entity\StockLanterne;
use Doctrine\Common\EventSubscriber;
use App\Service\Cache\ParcCacheService;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ParcCacheDoctrineSubscriber implements EventSubscriber
{
    public function __construct(private ParcCacheService $parcCacheService)
    {
        dd('ParcCacheDoctrineSubscriber');
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->invalidateIfRelated($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->invalidateIfRelated($args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->invalidateIfRelated($args);
    }

    private function invalidateIfRelated(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (
            $entity instanceof Parc
            || $entity instanceof Filiere
            || $entity instanceof Segment
            || $entity instanceof Emplacement
            || $entity instanceof StockCorde
            || $entity instanceof StockLanterne
        ) {
            $this->parcCacheService->refreshCache();
        }
    }
}
