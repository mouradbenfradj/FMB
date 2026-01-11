<?php

namespace App\Service\Interface;

use App\Entity\Parc;

interface PreparationInterface
{
    public function decrementNombreDeMaterielEnStock(): void;

    public function decrementeDensiterDeLarticle(): void;

    public function creationDeLarticle(): void;
}
