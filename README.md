Built for Sainsbury's by Dan Blows on 26 September 2015.

Setup
=====

1. Install php5-cli and php5-curl
2. Run `composer install --require-dev`
3. Make the `app/sainsburys-crawler` file executable ( e.g. chmod +x app/sainsburys-crawler )

Run the command
===============

Just run `app/sainsburys-crawler`

You'll be asked for a URL to consume. Alternatively, you can pass it on the initial command:

`app/sainsburys-crawler http://www.sainsburys.co.uk/your-url-here`

It will output formatted JSON to the command line.

Troubleshooting
===============

To enable debugging on HTTP requests, use the -vvv flag, i.e.

`app/sainsburys-crawler -vvv`

Run Tests
=========

vendor/bin/phpunit --bootstrap tests/bootstrap.php tests