<?php

namespace Tor2r\BrregAPi;

use Illuminate\Support\Facades\Http;
use Tor2r\BrregAPi\Exceptions\BrregApiException;

class BrregAPi
{
    protected string $baseUrl;

    protected string $registryPath = 'enhetsregisteret/api/enheter';

    protected string $embeddedKey = 'enheter';

    protected int $defaultLimit;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('brreg-api.base_url', 'https://data.brreg.no'), '/');
        $this->defaultLimit = (int) config('brreg-api.results_per_page', 100);
    }

    public function voluntary(): static
    {
        $instance = clone $this;
        $instance->registryPath = 'frivillighetsregisteret/api/frivillige-organisasjoner';
        $instance->embeddedKey = 'frivillige_organisasjoner';

        return $instance;
    }

    public function getByOrgnr(string $orgnr): array
    {
        $response = Http::accept('application/json')
            ->get("{$this->baseUrl}/{$this->registryPath}/{$orgnr}");

        if ($response->status() === 404) {
            throw BrregApiException::notFound($orgnr);
        }

        if ($response->failed()) {
            throw BrregApiException::requestFailed($response->status(), $response->body());
        }

        return $this->cleanEntity($response->json());
    }

    public function searchByName(string $name, ?int $limit = null): array
    {
        return $this->search(['navn' => $name], $limit);
    }

    protected function search(array $params, ?int $limit = null): array
    {
        $params['size'] = $limit ?? $this->defaultLimit;

        $response = Http::accept('application/json')
            ->get("{$this->baseUrl}/{$this->registryPath}", $params);

        if ($response->failed()) {
            throw BrregApiException::requestFailed($response->status(), $response->body());
        }

        return $this->formatSearchResponse($response->json());
    }

    protected function formatSearchResponse(array $response): array
    {
        $entities = $response['_embedded'][$this->embeddedKey] ?? [];
        $page = $response['page'] ?? [];

        return [
            'data' => array_map([$this, 'cleanEntity'], $entities),
            'meta' => [
                'per_page' => $page['size'] ?? 0,
                'total' => $page['totalElements'] ?? 0,
                'total_pages' => $page['totalPages'] ?? 0,
                'current_page' => $page['number'] ?? 0,
            ],
        ];
    }

    protected function cleanEntity(array $entity): array
    {
        unset($entity['_links'], $entity['respons_klasse']);

        return $entity;
    }
}
