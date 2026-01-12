<?php

namespace App\Service\DesignPatterns\PatronsStructurels\PoidsMouche;

use App\Service\DesignPatterns\PatronsStructurels\PoidsMouche\FlyweightFactory;

class PoidsMoucheService
{

    function addCarToPoliceDatabase(
        FlyweightFactory $ff,
        $plates,
        $owner,
        $brand,
        $model,
        $color
    ) {
        dump("\nClient: Adding a car to database.");
        $flyweight = $ff->getFlyweight([$brand, $model, $color]);

        // The client code either stores or calculates extrinsic state and passes it
        // to the flyweight's methods.
        $flyweight->operation([$plates, $owner]);
    }


    public function runPoidsMoucheService()
    {




        /**
         * The client code usually creates a bunch of pre-populated flyweights in the
         * initialization stage of the application.
         */
        $factory = new FlyweightFactory([
            ["Chevrolet", "Camaro2018", "pink"],
            ["Mercedes Benz", "C300", "black"],
            ["Mercedes Benz", "C500", "red"],
            ["BMW", "M5", "red"],
            ["BMW", "X6", "white"],
            // ...
        ]);
        $factory->listFlyweights();

        // ...

        $this->addCarToPoliceDatabase(
            $factory,
            "CL234IR",
            "James Doe",
            "BMW",
            "M5",
            "red",
        );

        $this->addCarToPoliceDatabase(
            $factory,
            "CL234IR",
            "James Doe",
            "BMW",
            "X1",
            "red",
        );

        $factory->listFlyweights();
    }
}
