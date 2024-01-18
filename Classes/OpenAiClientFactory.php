<?php
declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;
use OpenAI\Contracts\ClientContract;
use OpenAI\Factory;
use Psr\Http\Client\ClientInterface;

class OpenAiClientFactory
{
    #[Flow\InjectConfiguration(path: 'apiKey')]
    protected ?string $apiKey = '';

    #[Flow\InjectConfiguration(path: 'organisation')]
    protected ?string $organisation = '';

    #[Flow\Inject]
    protected ClientInterface $client;

    public function createClient(): ClientContract
    {
        $factory = (new Factory())
            ->withHttpClient($this->client)
            ->withApiKey($this->apiKey)
            ->withHttpHeader('OpenAI-Beta', 'assistants=v1')
            ->withOrganization($this->organisation);
        return $factory->make();
    }
}
