# Changelog

All notable changes to `laravel-brreg-api` will be documented in this file.

## 1.1.0 - 2026-02-11

- Search responses now return structured `data` and `meta` arrays instead of raw API response
- Internal API fields (`_links`, `respons_klasse`) are stripped from all responses

## 1.0.0 - 2026-02-11

- Support for PHP 8.2 - 8.5 and Laravel 11 - 12
- Fetch entity by organisation number from Enhetsregisteret
- Search by organisation number and name
- Support for Frivillighetsregisteret via `voluntary()`
- Configurable results per page (default 100)
- Error handling with descriptive messages
