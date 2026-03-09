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
        $factory = (new Factory())
            ->withHttpClient($this->httpClient)
            ->withApiKey($record->apiKey)
            ->withOrganization($record->organisation);
        return $factory->make();
    }
}
