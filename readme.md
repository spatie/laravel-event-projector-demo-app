# Event sourcing for Artisans

This repo contains a Laravel app with a dev version of the [laravel-event-projector](https://github.com/spatie/laravel-event-projector) installed into it.

## Support us

[![Image](https://github-ads.s3.eu-central-1.amazonaws.com/laravel-event-projector-demo-app.jpg)](https://spatie.be/github-ad-click/laravel-event-projector-demo-app)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

1. Clone the repo
2. Copy `.env.example` to `.env`
3. Run `composer install`
4. Run `php artisan migrate:fresh --seed`

After these steps you should have many `StoredEvent`s. The  `accounts` and `transaction_counts` tables should be filled.