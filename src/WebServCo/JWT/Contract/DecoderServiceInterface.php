<?php

declare(strict_types=1);

namespace WebServCo\JWT\Contract;

use WebServCo\JWT\DataTransfer\Payload;

interface DecoderServiceInterface
{
    public function decodeJwt(string $jwt): Payload;
}
