<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Commande;

use App\Service\DesignPatterns\PatronsComportementaux\Commande\Invoker;
use App\Service\DesignPatterns\PatronsComportementaux\Commande\Receiver;
use App\Service\DesignPatterns\PatronsComportementaux\Commande\SimpleCommand;
use App\Service\DesignPatterns\PatronsComportementaux\Commande\ComplexCommand;

class CommandeService
{
    public function run()
    {

        /**
         * The client code can parameterize an invoker with any commands.
         */

        $invoker = new Invoker();
        $invoker->setOnStart(new SimpleCommand("Say Hi!"));
        $receiver = new Receiver();
        $invoker->setOnFinish(new ComplexCommand($receiver, "Send email", "Save report"));

        $invoker->doSomethingImportant();
    }
}
