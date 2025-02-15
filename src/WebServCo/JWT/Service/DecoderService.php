<?php

declare(strict_types=1);

namespace WebServCo\JWT\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Override;
use UnexpectedValueException;
use WebServCo\JWT\Contract\DecoderServiceInterface;
use WebServCo\JWT\DataTransfer\Payload;

use function is_scalar;
use function property_exists;
use function sprintf;
use function strval;

final class DecoderService implements DecoderServiceInterface
{
    private const ALGORITHM = 'HS256';

    private Key $key;

    public function __construct(string $jwtSecret)
    {
        $this->key = new Key($jwtSecret, self::ALGORITHM);
    }

    /**
     * JWT class: there is only static access
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    #[Override]
    public function decodeJwt(string $jwt): Payload
    {
        $payload = JWT::decode($jwt, $this->key);

        foreach (['iss', 'sub'] as $key) {
            if (!property_exists($payload, $key)) {
                throw new UnexpectedValueException(sprintf('Payload is missing required property "%s"', $key));
            }
        }

        if (!is_scalar($payload->iss)) {
            throw new UnexpectedValueException(sprintf('Payload iss is not scalar.'));
        }

        if (!is_scalar($payload->sub)) {
            throw new UnexpectedValueException(sprintf('Payload iss is not scalar.'));
        }

        return new Payload((string) $payload->iss, (string) $payload->sub);
    }
}
