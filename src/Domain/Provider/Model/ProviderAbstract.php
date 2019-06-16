<?php

namespace App\Domain\Provider\Model;

/**
 * Provider abstract class
 *
 * @author Sebastian Chmiel
 */
abstract class ProviderAbstract {

    /**
     * get provider code
     * 
     * @return string
     */
    public function getCode() {
        return static::CODE;
    }
    
    /**
     * get all data from provider
     * 
     * @param int $offset (default 0)
     * @param int|null $limit (default NULL)
     * 
     * @return array
     */
    public abstract function getAllData(int $offset = 0, ?int $limit = null): array;

}
