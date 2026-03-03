<?php

declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Http\Client\Browser;
use Neos\Flow\Http\Client\CurlEngine;
use OpenAI\Contracts\ClientContract;
use OpenAI\Factory;
use Psr\Http\Client\ClientInterface;

class OpenAiClientFactory
{
    protected ClientInterface $httpClient;

    public function __construct() {
        $engine = new CurlEngine();
        $engine->setOption(CURLOPT_TIMEOUT, 60);
        $this->httpClient = new Browser();
        $this->httpClient->setRequestEngine($engine);
    }

    public function createClientForAccountRecord(AccountRecord $record): ClientContract
    {
        $factory = (new Factory())->withHttpClient($this->httpClient);
        if ($record->apiKey !== null) {
            $factory = $factory->withApiKey($record->apiKey);
        }
        if ($record->organisation !== null) {
            $factory = $factory->withOrganization($record->organisation);
        }
        if ($record->baseUri !== null) {
            $factory = $factory->withBaseUri($record->baseUri);
        }
        foreach ($record->additionalHeaders as $header => $value) {
            $factory = $factory->withHttpHeader($header, $value);
        }
        foreach ($record->additionalQueryParams as $param => $value) {
            $factory = $factory->withQueryParam($param, $value);
        }

        return $factory->make();
    }
}
