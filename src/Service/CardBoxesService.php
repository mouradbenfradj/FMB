<?php

namespace App\Service;


class CardBoxesService
{
    private $text;
    private $icon;
    private $total;

    public function getText()
    {
        return $this->text;
    }
    public function getIcon()
    {
        return $this->icon;
    }
    public function getTotal()
    {
        return $this->total;
    }
    public function setText(string $text)
    {
        $this->text = $text;
        return $this->text;
    }
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this->icon;
    }
    public function setTotal(float $total)
    {
        $this->total = $total;
        return $this->total;
    }
}
