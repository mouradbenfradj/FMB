<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Procuration;

use App\Service\DesignPatterns\PatronsStructurels\Procuration\Proxy;
use App\Service\DesignPatterns\PatronsStructurels\Procuration\Subject;
use App\Service\DesignPatterns\PatronsStructurels\Procuration\RealSubject;

class ProcurationService
{

    /**
     * The client code is supposed to work with all objects (both subjects and
     * proxies) via the Subject interface in order to support both real subjects and
     * proxies. In real life, however, clients mostly work with their real subjects
     * directly. In this case, to implement the pattern more easily, you can extend
     * your proxy from the real subject's class.
     */
    function clientCode(Subject $subject)
    {
        // ...

        $subject->request();

        // ...
    }
    public function runProcurationService()
    {
        dump("Client: Executing the client code with a real subject:\n");
        $realSubject = new RealSubject();
        $this->clientCode($realSubject);

        dump("\n");

        dump("Client: Executing the same client code with a proxy:\n");
        $proxy = new Proxy($realSubject);
        $this->clientCode($proxy);
    }
}
