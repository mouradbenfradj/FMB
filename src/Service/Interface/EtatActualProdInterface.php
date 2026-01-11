<?php

namespace App\Service\Interface;

interface EtatActualProdInterface
{
    public function ref(): string;
    public function remplissage(): float;
    public function flottabiliter(): float;
    public function taille(): float;
    public function totalEmplacement(): int;
    public function emplacementVide(): int;
    public function emplacementRemplit(): int;
    public function totalCorde(): int;
    public function totalCordeHuitre(): int;
    public function totalCordeMoule(): int;
    public function totalCordeLanterne(): int;
    public function totalCordePoche(): int;
    public function dateDeMAE();
    public function passageChaussette(): int;
    public function segments();
}
