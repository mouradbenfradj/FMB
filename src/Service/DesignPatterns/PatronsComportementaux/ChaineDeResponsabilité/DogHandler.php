<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité;

use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\AbstractHandler;

class DogHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "MeatBall") {
            return "Dog: I'll eat the " . $request . ".";
        } else {
            return parent::handle($request);
        }
    }
}
