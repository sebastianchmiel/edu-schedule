<?php

namespace App\Domain\Provider\Providers\Audioteka\Model;

use App\Domain\Provider\Model\ProviderAbstract;
use App\Domain\Provider\Providers\Audioteka\Config\Config;
use App\Domain\Provider\Providers\Audioteka\Api\ApiAdapter;

/**
 * API adapter to get data from audioteka.com
 * website have not api, that should scrape data and racognize
 *
 * @author Sebastian Chmiel
 */
class AudiotekaProvider extends ProviderAbstract {

    /**
     * provider code
     */
    const CODE = 'audioteka';

    /**
     * provider configuration
     * 
     * @var Config
     */
    private $config;
    
    /**
     * provider api adapter
     * 
     * @var ApiAdapter
     */
    private $apiAdapter;
    
    /**
     * @param array $params
     */
    public function __construct(array $params) {
        $this->config = new Config($params);
        $this->apiAdapter = new ApiAdapter($this->config);
    }

    /**
     * get all data from provider
     * 
     * @param int $offset (default 0)
     * @param int|null $limit (default NULL)
     * 
     * @return array
     */
    public function getAllData(int $offset = 0, ?int $limit = null): array {
        // get all data
        return $this->apiAdapter->getAllData($offset, $limit);
    }
}
