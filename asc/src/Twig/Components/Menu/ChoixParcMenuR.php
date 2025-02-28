<?php
// src/Twig/Components/Alert.php
namespace App\Twig\Components\Menu;

use App\Entity\Parc;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class ChoixParcMenuR
{
    public Parc $parc;
}
