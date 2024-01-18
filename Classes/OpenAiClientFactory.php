<?php
declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;
use OpenAI\Client;
use OpenAI\Factory;
use Psr\Http\Client\ClientInterface;

class OpenAiClientFactory
{
    #[Flow\InjectConfiguration(path: 'apiKey')]
    protected string $apiKey = '';

    #[Flow\InjectConfiguration(path: 'organisation')]
    protected string $organisation = '';

    #[Flow\Inject]
    protected ClientInterface $client;

    public function createClient(): Client
    {
        $factory = (new Factory())
            ->withHttpClient($this->client)
            ->withApiKey($this->apiKey)
            ->withOrganization($this->organisation);
        return $factory->make();
    }
}
