<?php

declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;
use OpenAI\Contracts\ClientContract;
use OpenAI\Factory;
use Psr\Http\Client\ClientInterface;

class OpenAiClientFactory
{
    #[Flow\Inject]
    protected ClientInterface $httpClient;

    public function createClientForAccountRecord(AccountRecord $record): ClientContract
    {
        $factory = (new Factory())
            ->withHttpClient($this->httpClient)
            ->withApiKey($record->apiKey)
            ->withHttpHeader('OpenAI-Beta', 'assistants=v1')
            ->withOrganization($record->organisation);
        return $factory->make();
    }
}
