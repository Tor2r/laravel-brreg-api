Laravel 12 package for fetching data from Brønnøysundregisteret API.
This package uses Spatie's package skeleton. Se Readme.md for more info.
Pest for testing. Create basic tests.
Follow standard Laravel conventions. Code like you are Taylor Otwell.
Make it easy to add more features later, reuse code where possible.

Create service provider and facade.

Usage style:

- BrregApi::getByOrgnr('987654321'); https://data.brreg.no/enhetsregisteret/api/enheter/{enhetorgnr}

- BrregApi::searchByName('Lindga'); https://data.brreg.no/enhetsregisteret/api/enheter?navn=Sesam

Same for frivillige organisasjoner: https://data.brreg.no/frivillighetsregisteret/api/frivillige-organisasjoner

API documentation: https://data.brreg.no/enhetsregisteret/api/dokumentasjon/no/index.html

When searching, make it possible to define/limit the number of results returned. 100 by default, defined in config file.

Remember error handling with explained messages.

When making changes, adding features, update the readme.md and changelog.md.

Readme.md should contain installation instructions and basic usage.

If you think there should be more features, ask me.
Other important things this package might need, just ask me if I agree.

