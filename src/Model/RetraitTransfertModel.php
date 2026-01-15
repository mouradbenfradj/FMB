<?php

namespace App\Model;

class RetraitTransfertModel
{
    private ?\DateTime $dateTransfert = null;

    public function getDateTransfert(): ?\DateTime
    {
        return $this->dateTransfert;
    }

    public function setDateTransfert(?\DateTime $dateTransfert): static
    {
        $this->dateTransfert = $dateTransfert;

        return $this;
    }
}
