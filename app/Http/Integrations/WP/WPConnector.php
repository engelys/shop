<?php

namespace App\Http\Integrations\WP;

use App\Http\Integrations\HasDTOGenerator;
use Saloon\Http\Connector;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Http\Auth\MultiAuthenticator;
use Saloon\Http\Auth\QueryAuthenticator;
use Saloon\Traits\Plugins\HasTimeout;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class WPConnector extends Connector
{
    use AcceptsJson;
    use HasTimeout;
    use CreatesDtoFromResponse;
    use HasDTOGenerator;

    protected int $connectTimeout = 60;

    protected int $requestTimeout = 120;

    public function __construct(
        protected string $host,
        protected string $consumer_key,
        protected string $consumer_secret,
    )
    {

    }

    public function resolveBaseUrl(): string
    {
        return $this->host;
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new MultiAuthenticator(
            new QueryAuthenticator('consumer_key', $this->consumer_key),
            new QueryAuthenticator('consumer_secret', $this->consumer_secret)
        );
    }

    public function cacheExpiryInSeconds(): int
    {
        return 600;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();
        $request = $response->getRequest();

        // dd($this->generateDTO(class_basename($request), json_encode($data), __DIR__, __NAMESPACE__));

        $dtoModel = $request->responseDto();
        return new $dtoModel($data);
    }
}
