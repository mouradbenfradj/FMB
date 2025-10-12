<?php

namespace App\EventSubscriber;

use App\Entity\StockCorde;
use App\Service\MouleCalculator;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PostLoadEventArgs;
use Doctrine\ORM\Events;

class StockCordeSubscriber implements EventSubscriberInterface
{
    public function __construct(private MouleCalculator $mouleCalculator) {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::postLoad,
        ];
    }

    public function postLoad(PostLoadEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof StockCorde) {
            // Utilisez la réflexion pour injecter le service
            $reflection = new \ReflectionClass($entity);

            // Vérifie si la propriété existe
            if ($reflection->hasProperty('mouleCalculator')) {
                $property = $reflection->getProperty('mouleCalculator');
                $property->setAccessible(true);
                $property->setValue($entity, $this->mouleCalculator);
            }
        }
    }
}
