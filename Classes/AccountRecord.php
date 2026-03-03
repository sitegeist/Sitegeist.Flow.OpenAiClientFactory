<?php

declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;

#[Flow\Proxy(false)]
class AccountRecord
{
    /**
     * @param array<string, string> $additionalHeaders
     * @param array<string, string> $additionalQueryParams
     */
    public function __construct(
        public readonly string $name,
        public readonly ?string $apiKey = null,
        public readonly ?string $organisation = null,
        public readonly ?string $baseUri = null,
        public readonly array $additionalHeaders = [],
        public readonly array $additionalQueryParams = [],
    ) {
    }

    /**
     * @param array<string,mixed> $configuration
     */
    public static function fromConfiguration(string $name, array $configuration): self
    {
        return new self(
            $name,
            $configuration['apiKey'] ?? null,
            $configuration['organisation'] ?? null,
            $configuration['baseUri'] ?? null,
            $configuration['additionalHeaders'] ?? [],
            $configuration['additionalQueryParams'] ?? [],
        );
    }
}
