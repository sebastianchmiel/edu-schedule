<?php

namespace App\Domain\Provider\Config;

/**
 * Model for provider configuration
 *
 * @author Sebastian Chmiel
 */
interface ConfigInterface {
    /**
     * valid parameters
     * 
     * @param array $params
     * 
     * @return void
     * 
     * @throws NoProviderParamException
     */
    public function validParams(array $params): void;
    
    /**
     * read params from env
     * 
     * @param array $params
     * 
     * @return void
     * 
     * @throws NoProviderParamException
     */
    public function readParams(array $params): void;
}
