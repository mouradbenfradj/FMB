<?php

namespace App\Interfaces\Visiteur\Operation;

use App\Entity\Asc\Stock\StockCorde;

interface OperationInterface
{
    public function preparationCorde(StockCorde $stockCorde);
    public function preparationLanterne();
    public function assemblageCorde();
    public function assemblageLanterne();
    public function miseAEauCorde();
    public function miseAEauLanterne();
    public function chaussageCorde();
    public function chaussageLanterne();
    public function retraitTransfertCorde();
    public function retraitTransfertLanterne();
    public function traitementCommercialeCorde();
    public function traitementCommercialeLanterne();
}
