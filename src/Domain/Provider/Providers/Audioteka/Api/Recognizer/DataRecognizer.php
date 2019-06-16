<?php

namespace App\Domain\Provider\Providers\Audioteka\Api\Recognizer;

/**
 * Data recognizer
 *
 * @author Sebastian Chmiel 
 */
class DataRecognizer {

    /**
     * recognize form token
     * @param string $response
     * @return string|null
     */
    public static function recognizeToken(string $response): ?string {
        preg_match_all('/<input(.*?)id=\"_token\"(.*?)value=\"(.*?)\"/i', $response, $matches);
        return $matches[3][0] ?? null;
    }

    /**
     * recognize links to details
     * @param string $response
     * @return array
     */
    public static function recognizeLinksToDetails(string $response): array {
        preg_match_all('/<a href=\"(.*?)\" class=\"item-presentation__img\">/i', $response, $matches);
        return $matches[1] ?? [];
    }

    /**
     * recognize title
     * @param string $response
     * @return string|null
     */
    public static function recognizeTitle(string $response): ?string {
        preg_match('/<h1 class=\"product-title\">(.*?)<\/h1>/i', $response, $matches);
        return isset($matches[1]) ? trim($matches[1]) : null;
    }

    /**
     * recognize image src
     * @param string $response
     * @return string|null
     */
    public static function recognizeImage(string $response): ?string {
        preg_match('/<img src=\"(.*?)\" alt=\".*?\" title=\".*?\" itemprop=\"thumbnailUrl\">/i', $response, $matches);
        return isset($matches[1]) ? 'https:' . trim($matches[1]) : null;
    }

    /**
     * recognize rating value
     * @param string $response
     * @return float|null
     */
    public static function recognizeRating(string $response): ?float {
        preg_match('/<div class=\"rating__avg\">\s(.*?)\s<\/div>/i', $response, $matches);
        return isset($matches[1]) ? (float) $matches[1] : null;
    }

    /**
     * recognize rating votes
     * @param string $response
     * @return int|null
     */
    public static function recognizeRatingVotes(string $response): ?int {
        preg_match('/<a href=\"#comments\">.*?(<span class=\"count p-count\">|)(.*?)(<\/span>|) opini(i|a) <\/a>/ism', $response, $matches);
        return isset($matches[2]) ? (trim($matches[2]) == 'jedna' ? 1 : (int) strip_tags($matches[2])) : null;
    }

    /**
     * recognize length  
     * @param string $response
     * @return int|null
     */
    public static function recognizeLength(string $response): ?int {
        // length
        preg_match('/<span class=\"text-label\">Długość:<\/span>\s<span class=\"text\">(.*?)<\/span>/i', $response, $matches);
        $lengthString = isset($matches[1]) ? trim($matches[1]) : null;

        preg_match('/([0-9]+) godzin(y|)/i', $lengthString, $hourMatches);
        $hours = isset($hourMatches[1]) ? (int) $hourMatches[1] : 0;

        preg_match('/([0-9]+) minut(y|)/i', $lengthString, $minutMatches);
        $minutes = isset($minutMatches[1]) ? (int) $minutMatches[1] : 0;

        return $hours * 60 + $minutes;
    }

    /**
     * recognize author
     * @param string $response
     * @return string|null
     */
    public static function recognizeAuthor(string $response): ?string {
        preg_match('/<span class=\"text-label\">Autor:<\/span>.*?<span class=\"text\">(.*?)<\/span>/ims', $response, $matches);
        return isset($matches[1]) ? trim(str_replace("\n", ' ', strip_tags($matches[1]))) : null;
    }

    /**
     * recognize lector
     * @param string $response
     * @return string|null
     */
    public static function recognizeLector(string $response): ?string {
        preg_match('/<span class=\"text-label\">Czyta:<\/span>\s<span class=\"text\">\s<a href=\".*?\">(.*?)<\/a>\s<\/span>/i', $response, $matches);
        return isset($matches[1]) ? trim($matches[1]) : null;
    }

    /**
     * recognize category
     * @param string $response
     * @return string|null
     */
    public static function recognizeCategory(string $response): ?string {
        preg_match('/<a href=\".*?\" class=\"category p-category\">(.*?)<\/a>/i', $response, $matches);
        return isset($matches[1]) ? trim($matches[1]) : null;
    }

    /**
     * recognize description
     * @param string $response
     * @return string|null
     */
    public static function recognizeDescription(string $response): ?string {
        preg_match('/<h2 class=\"hr-text__title\">Opis<\/h2>.*?<\/div>.*?<div>(.*?)<\/div>/ims', $response, $matches);
        return isset($matches[1]) ? trim(str_replace("\n", '', nl2br(strip_tags($matches[1]))), '<br />') : null;
    }

}
