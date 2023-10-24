This is a demonstration for a creatable Symfony Autocomplete form field.


## Requirements

- PHP 8.0 with sqlite extension
- Composer

## Installation

1. Clone this repository
2. Run `composer install`
3. Run `php bin/console doctrine:database:create`
4. Run `php bin/console doctrine:migrations:migrate`
5. Run `php bin/console doctrine:fixtures:load`
6. Run `symfony server:start`
