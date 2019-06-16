<?php

namespace App\Controller\Test;

use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Provider\Collection\ProviderCollection;
use App\Domain\Provider\Model\ProviderAbstract;

class TestController {

    /**
     * @Route("/test", name="test")
     */
    public function test(ProviderCollection $providerCollection) {
        /* @var $provider ProviderAbstract */
        foreach ($providerCollection->getProviders() as $key => $provider) {
            dump($key, $provider->getAllData(0, 1));
        }
        die;
    }

}
