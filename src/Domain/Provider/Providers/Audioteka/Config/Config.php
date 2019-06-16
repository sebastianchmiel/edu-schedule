<?php

namespace App\Domain\Provider\Providers\Audioteka\Config;

use App\Domain\Provider\Config\ConfigInterface;
use App\Domain\Provider\Exception\NoProviderParamException;

/**
 * Provider configuration
 *
 * @author Sebastian Chmiel
 */
class Config implements ConfigInterface {
    /**
     * param field for url
     */
    const FIELD_URL = 'url';

    /**
     * param field for login
     */
    const FIELD_LOGIN = 'login';

    /**
     * param field for pass
     */
    const FIELD_PASS = 'pass';

    /**
     * api url
     * @var string
     */
    private $url;
    
    /**
     * login
     * 
     * @var string
     */
    private $login;

    /**
     * password
     * 
     * @var string
     */
    private $pass;

    /**
     * @param array $params
     */
    public function __construct(array $params) {
        $this->readParams($params);
    }

    /**
     * get api base url
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }
    
    /**
     * get login for authorization
     * @return string
     */
    public function getLogin(): string {
        return $this->login;
    }
    
    /**
     * get pass for authorisation
     * @return string
     */
    public function getPass(): string {
        return $this->pass;
    }
    
    /**
     * read params from env
     * 
     * @param array $params
     * 
     * @return void
     * 
     * @throws NoProviderParamException
     */
    public function readParams(array $params): void {
        $this->validParams($params);

        // read params
        $this->url = $params[self::FIELD_URL];
        $this->login = $params[self::FIELD_LOGIN];
        $this->pass = $params[self::FIELD_PASS];
    }

    /**
     * valid parameters
     * 
     * @param array $params
     * 
     * @return void
     * 
     * @throws NoProviderParamException
     */
    public function validParams(array $params): void {
        if (!isset($params[self::FIELD_URL])) {
            throw new NoProviderParamException('Not defined parameter ' . self::FIELD_URL . ' for provider ' . self::CODE);
        }
        if (!isset($params[self::FIELD_LOGIN])) {
            throw new NoProviderParamException('Not defined parameter ' . self::FIELD_LOGIN . ' for provider ' . self::CODE);
        }
        if (!isset($params[self::FIELD_PASS])) {
            throw new NoProviderParamException('Not defined parameter ' . self::FIELD_PASS . ' for provider ' . self::CODE);
        }
    }

}
