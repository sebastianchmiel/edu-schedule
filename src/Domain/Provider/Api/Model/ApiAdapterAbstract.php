<?php

namespace App\Domain\Provider\Api\Model;

use App\Domain\Provider\Config\ConfigInterface;

/**
 * Api adapter abstracto
 *
 * @author Sebastian Chmiel
 */
abstract class ApiAdapterAbstract {
    /**
     * provider config
     * 
     * @var Config
     */
    protected $config;
    
    /**
     * flag define is is connecting for api
     * @var bool
     */
    protected $isConnected = false;
    
    /**
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config) {
        $this->config = $config;
    }
    
    /**
     * connect to provider
     * 
     * @return void
     * 
     * @throws ConnectionFailedException
     */
    public abstract function connect(): void;
    
    /**
     * getl all data (all items from provider)
     * 
     * @return array
     */
    public abstract function getAllData(): array;
}
