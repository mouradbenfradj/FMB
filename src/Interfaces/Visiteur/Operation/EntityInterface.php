<?php

namespace App\Interfaces\Visiteur\Operation;

interface EntityInterface
{
    public function accept(OperationInterface $operationInterface);
    public function preparation(OperationInterface $operationInterface);
    public function assemblage(OperationInterface $operationInterface);
    public function miseAEau(OperationInterface $operationInterface);
    public function chaussage(OperationInterface $operationInterface);
    public function retraitTransfert(OperationInterface $operationInterface);
    public function traitementCommerciale(OperationInterface $operationInterface);
}
