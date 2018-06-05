# Event sourcing for Artisans

This repo contains a Laravel app with a dev version of the [laravel-event-projector](https://github.com/spatie/laravel-event-projector) installed into it.

## Installation

1. Clone the repo
2. Copy `.env.example` to `.env`
3. Run `composer install`
4. Run `php artisan migrate:fresh --seed`

After these steps you should have many `StoredEvent`s. The  `accounts` and `transaction_counts` tables should be filled.