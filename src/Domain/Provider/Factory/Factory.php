<?php

namespace App\Domain\Provider\Factory;

use App\Domain\Provider\Model\ProviderAbstract;

/**
 * Create provider model
 *
 * @author Sebastian Chmiel
 */
class Factory {

    /**
     * create provider object
     * 
     * @param string $providerClass
     * @param array $params
     * 
     * @return ProviderAbstract
     */
    public static function create(string $providerClass, array $params): ProviderAbstract {
        return new $providerClass($params);
    }

}
