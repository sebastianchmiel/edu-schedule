<?php

namespace App\Domain\Provider\Collection;

use App\Domain\Provider\Factory\Factory;
use App\Domain\Provider\Providers\Audioteka\Model\AudiotekaProvider;

/**
 * Collection of providers
 *
 * @author Sebastian Chmiel
 */
class ProviderCollection {
    
    /**
     * providers collection
     */
    private $providers;
    
    /**
     * @param array $audiotekaParams
     */
    public function __construct(array $audiotekaParams) {
        // add providers
        $this->providers[AudiotekaProvider::CODE] = 
                Factory::create(AudiotekaProvider::class, $audiotekaParams);
    }

    /**
     * get providers
     * @return array
     */
    public function getProviders(): array {
        return $this->providers;
    }
}
