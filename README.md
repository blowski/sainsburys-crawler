Built for Sainsbury's by Dan Blows on 26 September 2015.

Setup
=====

1. Install php5-cli and php5-curl
2. Run `composer install --require-dev`
3. Make the `app/sainsburys-crawler` file executable ( e.g. chmod +x app/sainsburys-crawler )

Run the command
===============

Just run `app/sainsburys-crawler`

This will output JSON to the command line

Run Tests
=========

vendor/bin/phpunit tests