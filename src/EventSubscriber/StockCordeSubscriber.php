<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use App\Entity\StockCorde;
use App\Service\MouleCalculator;
use Doctrine\ORM\Event\PostLoadEventArgs;
use Symfony\Bridge\Doctrine\Attribute\AsDoctrineListener;

#[AsDoctrineListener(event: Events::postLoad)]
class StockCordeSubscriber
{
    public function __construct(private MouleCalculator $mouleCalculator) {}

    public function __invoke(StockCorde $entity): void
    {
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
