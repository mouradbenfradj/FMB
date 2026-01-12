<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Procuration;

use App\Service\DesignPatterns\PatronsStructurels\Procuration\Subject;

/**
 * The RealSubject contains some core business logic. Usually, RealSubjects are
 * capable of doing some useful work which may also be very slow or sensitive -
 * e.g. correcting input data. A Proxy can solve these issues without any
 * changes to the RealSubject's code.
 */
class RealSubject implements Subject
{
    public function request(): void
    {
        dump("RealSubject: Handling request.\n");
    }
}
