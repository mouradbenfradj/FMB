<?php

namespace App\Model;

use App\Entity\Corde;
use DateTime;

class MAECordeModel
{
    private ?Corde $corde = null;
    private ?DateTime $datedeMAE = null;
    private ?string $disponibiliter = null;
    public function getDisponibiliter(): ?string
    {
        return $this->disponibiliter;
    }
    public function setDisponibiliter(?string $disponibiliter): self
    {
        $this->disponibiliter = $disponibiliter;
        return $this;
    }
    public function getCorde(): ?Corde
    {
        return $this->corde;
    }

    public function setCorde(?Corde $corde): self
    {
        $this->corde = $corde;
        return $this;
    }

    public function getDatedeMAE(): ?DateTime
    {
        return $this->datedeMAE;
    }

    public function setDatedeMAE(?DateTime $datedeMAE): self
    {
        $this->datedeMAE = $datedeMAE;
        return $this;
    }
}
