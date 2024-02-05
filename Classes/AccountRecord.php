<?php

declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;

#[Flow\Proxy(false)]
class AccountRecord
{
    public function __construct(
        public readonly string $name,
        public readonly string $apiKey,
        public readonly string $organisation,
    ) {
    }

    /**
     * @param array<string,mixed> $configuration
     */
    public static function fromConfiguration(string $name, array $configuration): self
    {
        return new self(
            $name,
            $configuration['apiKey'],
            $configuration['organisation'],
        );
    }
}
