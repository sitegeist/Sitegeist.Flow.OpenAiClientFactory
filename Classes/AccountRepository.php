<?php

declare(strict_types=1);

namespace Sitegeist\Flow\OpenAiClientFactory;

use Neos\Flow\Annotations as Flow;

#[Flow\Scope('singleton')]
class AccountRepository
{
    #[Flow\InjectConfiguration(path: 'accounts')]
    protected ?array $accounts = [];

    /**
     * @return array<AccountRecord>
     */
    public function findAll(): array
    {
        return array_map(
            fn (array $data, string $name): AccountRecord => AccountRecord::fromConfiguration($name, $data),
            $this->accounts,
            array_keys($this->accounts)
        );
    }

    public function findById(string $id): AccountRecord
    {
        if (array_key_exists($id, $this->accounts)) {
            return AccountRecord::fromConfiguration($id, $this->accounts[$id]);
        }

        throw new \Exception('Unknown account "' . $id . '"', 1707149688);
    }
}
