<?php
declare(strict_types=1);

namespace App\Domain\Account\Services;

use App\Domain\Account\Repositories\ProgressionRepository;

final class ProgressionReader
{
    public function __construct(
        private readonly ProgressionRepository $progression = new ProgressionRepository(),
    ) {
    }

    public function current(): array
    {
        return $this->progression->currentForUser();
    }
}
