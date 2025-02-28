<?php
// src/Twig/Components/Alert.php
namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class RoundedCircleCounterUp
{
    public string $niveau;
    public string $icon;
    public string $titre;
    public int $value;
}
