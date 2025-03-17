# gFontDownloader

[![Latest Stable Version](https://img.shields.io/packagist/v/smtws/google-font-downloader.svg)](https://packagist.org/packages/smtws/google-font-downloader)
[![Total Downloads](https://img.shields.io/packagist/dt/smtws/google-font-downloader.svg)](https://packagist.org/packages/smtws/google-font-downloader)

gFontDownloader is a PHP tool that allows you to download Google Fonts and create local CSS files for them.

## Features

- Download Google Fonts to a local directory
- Create local CSS files for the downloaded fonts
- PSR-3 compatible logging

## Configuration

You can configure gFontDownloader using one of the following methods:

1. Set configuration in `config.json` and call `->setConfig()`
2. Set configuration via `->setConfig([array of configuration key-value pairs])`
3. Set configuration via `->setConfig($key, $value)`

Combinations of these methods are possible.

### Configuration Options

- `output`: Directory where fonts are downloaded to (each font family will have its own subdirectory). Defaults to `./`
- `formats`: Optional array of font formats to be downloaded. Defaults to all valid values. Valid values are: `eot`, `woff`, `woff2`, `svg`, `ttf`
- `onRecoverableError`: How to handle recoverable errors. Valid values are: `stop` (default), `recover`

## Adding Fonts to Download List

You can add fonts to the download list using one of the following methods:

- `->addFont(string $fontFamily, string $fontStyle, array $fontWeights)`

or

- `->addFontByUrl(string $urlOfFont)`

Examples:
- `"https://fonts.google.com/?selection.family=Gelasio:500i,700|Open+Sans|Roboto"`
- `"https://fonts.googleapis.com/css?family=Gelasio:500i,700|Open+Sans|Roboto&display=swap"`

## Running the Downloader

To start the download process, call `->download()`. This method:

- Returns an array of all downloaded fonts
- Accepts a callback function that is passed information on each font individually

## Error Handling

In case of unrecoverable errors, you can run `->createFamilyCssFiles()` to create Font Family CSS files for fonts that were successfully downloaded before the error occurred (see `example.php`).

## Logging

You can use PSR-3 compatible loggers with gFontDownloader:

```php
->setLogger(new \PSRCompatibleLogger());
```

## Example Usage

Here is an example of how to use gFontDownloader:

```php
<?php

require 'vendor/autoload.php';

use smtws\gFontDownloader;

// Create a new instance of the downloader
$downloader = new gFontDownloader();

// Set configuration
$downloader->setConfig([
    'output' => 'fonts/',
    'formats' => ['woff2', 'ttf'],
    'onRecoverableError' => 'recover'
]);

// Add fonts to the download list
$downloader->addFont('Gelasio', 'italic', [500, 700]);
$downloader->addFontByUrl('https://fonts.googleapis.com/css?family=Open+Sans|Roboto&display=swap');

// Set a logger (optional)
$downloader->setLogger(new \MyLogger());

// Run the downloader
$downloadedFonts = $downloader->download();

// Handle downloaded fonts
foreach ($downloadedFonts as $font) {
    echo "Downloaded font: " . $font['family'] . "\n";
}

```

For more details, refer to the [example.php](example.php) file.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
