<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Mediateur;

interface MediatorInterface
{
    public function notify(object $sender, string $event): void;
}
