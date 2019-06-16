<?php

namespace App\Domain\Provider\Providers\Audioteka\Api;

use App\Domain\Provider\Api\Model\ApiAdapterAbstract;
use App\Domain\Provider\Api\Exception\ConnectionFailedException;
use App\Domain\Provider\Providers\Audioteka\Api\Recognizer\DataRecognizer;
use App\Domain\Position\Model\Position;

/**
 * Api adapter for audioteka.com
 *
 * @author Sebastian
 */
class ApiAdapter extends ApiAdapterAbstract {

    /**
     * curl handler
     * @var resource
     */
    private $ch;

    /**
     * connect to provider
     * 
     * @return void
     * 
     * @throws ConnectionFailedException
     */
    public function connect(): void {
        if ($this->isConnected) {
            return;
        }

        $cookiePath = '/';

        // get token
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->config->getUrl() . 'signin/login');
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookiePath);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookiePath);
        $response = curl_exec($this->ch);
        if (curl_error($this->ch)) {
            throw new ConnectionFailedException('API Audioteka: cannot connect (open login page error)');
        }
        $token = DataRecognizer::recognizeToken($response);
        if (!$token) {
            throw new ConnectionFailedException('API Audioteka: cannot connect (get token error)');
        }

        // login check
        $params = [
            '_username' => $this->config->getLogin(),
            '_password' => $this->config->getPass(),
            '_remember_me' => 1,
            '_failure_path' => 'login',
            '_token' => $token,
        ];
        curl_setopt($this->ch, CURLOPT_URL, $this->config->getUrl() . 'user/login_check');
        curl_setopt($this->ch, CURLOPT_REFERER, $this->config->getUrl() . 'signin/login');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($this->ch);
        if (curl_error($this->ch)) {
            throw new ConnectionFailedException('API Audioteka: cannot connect (login check error)');
        }

        if (strpos($response, 'Moja półka') === false) {
            throw new ConnectionFailedException('API Audioteka: cannot connect (login error)');
        }

        $this->isConnected = true;
    }

    /**
     * get all data (items)
     * 
     * @param int $offset (default 0)
     * @param int|null $limit (default NULL)
     * 
     * @return array
     */
    public function getAllData(int $offset = 0, ?int $limit = null): array {
        $data = [];

        // connect
        $this->connect();

        // get links to details
        $linksAll = $this->getLinksToItemDetails();
        $links = array_slice($linksAll, $offset, $limit);
        
        foreach ($links as $link) {
            $data[] = $this->getItemDetail($link);
        }

        return $data;
    }

    /**
     * get links to item details
     * 
     * @return array
     */
    private function getLinksToItemDetails(): array {
        $links = [];

        $wasResult = true;
        $i = 1;
        while ($wasResult) {
            // get items from one page
            curl_setopt($this->ch, CURLOPT_URL, $this->config->getUrl() . 'my-shelf/' . $i . '?sort=name_asc');
            $response = curl_exec($this->ch);

            // get all links to details
            $linksFromPage = DataRecognizer::recognizeLinksToDetails($response);
            $links = array_merge($links, $linksFromPage);

            if (empty($linksFromPage)) {
                $wasResult = false;
            }
            $i++;
        }

        return $links;
    }

    /**
     * get item details and return position object
     * 
     * @param string $link
     * 
     * @return Position
     */
    private function getItemDetail(string $link): Position {
        $position = new Position();
        $position->setUrl($link);

        // get items from one page
        curl_setopt($this->ch, CURLOPT_URL, $link);
        $response = curl_exec($this->ch);
        
        $position->setTitle(DataRecognizer::recognizeTitle($response))
                ->setImg(DataRecognizer::recognizeImage($response))
                ->setRating(DataRecognizer::recognizeRating($response))
                ->setRatingVotes(DataRecognizer::recognizeRatingVotes($response))
                ->setLength(DataRecognizer::recognizeLength($response))
                ->setAuthor(DataRecognizer::recognizeAuthor($response))
                ->setLector(DataRecognizer::recognizeLector($response))
                ->setCategory(DataRecognizer::recognizeCategory($response))
                ->setDescription(DataRecognizer::recognizeDescription($response))
                ;

        return $position;
    }
}
