<?php

namespace App\Service\Materiel;

use App\Service\Interface\TravailleAFaireInterface;

/**
 * The Creator declares a factory method that can be used as a substitution for
 * the direct constructor calls of products, for instance:
 *
 * - Before: $p = new CordeService();
 * - After: $p = $this->getMateriel;
 *
 * This allows changing the type of the product being created by
 * SocialNetworkPoster's subclasses.
 */
abstract class MaterielService
{
    /**
     * The actual factory method. Note that it returns the abstract connector.
     * This lets subclasses return any concrete connectors without breaking the
     * superclass' contract.
     */
    abstract public function getMateriel(): TravailleAFaireInterface;

    /**
     * When the factory method is used inside the Creator's business logic, the
     * subclasses may alter the logic indirectly by returning different types of
     * the connector from the factory method.
     */
    public function preparation($form): void
    {
        // Call the factory method to create a Product object...
        $materiel = $this->getMateriel();
        // ...then use it as you will.
        $materiel->preparation($form);
    }
}
