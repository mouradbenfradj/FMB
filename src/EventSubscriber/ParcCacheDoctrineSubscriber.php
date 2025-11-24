<?php

namespace App\EventSubscriber;

use App\Entity\Corde;
use App\Entity\Emplacement;
use App\Entity\Filiere;
use App\Entity\Flotteur;
use App\Entity\FlotteurSegment;
use App\Entity\FruitDeMer;
use App\Entity\Lanterne;
use App\Entity\Parc;
use App\Entity\Segment;
use App\Entity\Stock;
use App\Entity\StockCorde;
use App\Entity\StockLanterne;
use App\Service\ParcCacheService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ParcCacheDoctrineSubscriber implements EventSubscriber
{
    public function __construct(private ParcCacheService $parcCacheService) {}

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
