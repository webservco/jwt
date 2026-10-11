# webservco/jwt

A PHP component/library. Please see [webservco/sandbox](https://webservco.github.io/sandbox/) for an example project using these types of components.

Decodes and verifies an HS256 JSON Web Token and returns its issuer and subject.

- Requires: `firebase/php-jwt` (installed with this package), a shared secret
- Related: `webservco/jsonapi-application` (API endpoints usually protected by a token)

---

## Installation

```shell
composer require webservco/jwt
```

---

## Usage

```php
use WebServCo\JWT\Service\DecoderService;

// \WebServCo\JWT\Contract\DecoderServiceInterface
$decoderService = new DecoderService($configurationGetter->getString('JWT_SECRET'));

// The token from the "Authorization: Bearer <token>" header.
// \WebServCo\JWT\DataTransfer\Payload
$payload = $decoderService->decodeJwt($token);

$userId = $payload->sub;
$issuer = $payload->iss;
```

The `webservco/sandbox` project does this in its `ApiAuthenticationMiddleware`, and then sets the user ID as a request attribute.

---

## Contracts

| Interface | Implementation | Purpose |
| --- | --- | --- |
| `Contract\DecoderServiceInterface` | `Service\DecoderService` | Verifies the signature and returns the payload. |
| none | `DataTransfer\Payload` | Readonly `iss` and `sub`. |

Namespaces are relative to `WebServCo\JWT\`.

---

## Configuration

The secret can come from anywhere. The sandbox project reads it from:

```ini
[API]

JWT_SECRET = a-long-random-string
```

---

## Notes

Only HS256 is accepted. An invalid signature, an expired token or a malformed token throws the exceptions from `firebase/php-jwt`. A token without `iss` or `sub` throws an `UnexpectedValueException`.

To create a test token, use the debugger on [jwt.io](https://jwt.io) with the same secret.

---

## Development

```shell
# Start project.
ddev start
# Install dependencies.
ddev c u
# Run all validations.
ddev c c
# Run unit tests.
ddev c test:dox
```

---

## License

[MIT](LICENSE.md)
