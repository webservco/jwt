<?php

declare(strict_types=1);

namespace WebServCo\JWT\DataTransfer;

use WebServCo\Data\Contract\Transfer\DataTransferInterface;

final readonly class Payload implements DataTransferInterface
{
    public function __construct(public string $iss, public string $sub)
    {
    }
}
