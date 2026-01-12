<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité;

use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\AbstractHandler;


class SquirrelHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "Nut") {
            return "Squirrel: I'll eat the " . $request . ".";
        } else {
            return parent::handle($request);
        }
    }
}
