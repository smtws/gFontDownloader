# gFontDownloader 
[![Latest Stable Version](https://img.shields.io/packagist/v/smtws/google-font-downloader.svg)](https://packagist.org/packages/smtws/google-font-downloader)
[![Total Downloads](https://img.shields.io/packagist/dt/smtws/google-font-downloader.svg)](https://packagist.org/packages/smtws/google-font-downloader)

php google fonts downloader with local css creation

### Configuration via 3 options

  1. set Configuration in config.json and just call ->setConfig();
  2. set configuration via ->setConfig([array of configuration key value pairs]);
  3. set configuration via ->setConfig($key,$value);

combinations are possible

### configurables:

  - output: directory where fonts are downloaded to (each font family will have its own subdirectory) defaults to ./
  - formats: optional array of font formats to be downloaded, defaults to all valid values. valid: eot,woff,woff2,svg,ttf
  - onRecoverableError: how to handle recoverable errors. valid: stop(default), recover
  
### add Fonts to Download list:

  - ->addFont(string $fontFamily,string $fontStyle, array $fontWeights);
  
  or
  
  - ->addFontByUrl(string $urlOfFont); 
  
  (e.g. "https://fonts.google.com/?selection.family=Gelasio:500i,700|Open+Sans|Roboto" or "https://fonts.googleapis.com/css?family=Gelasio:500i,700|Open+Sans|Roboto&display=swap")
  
### run:

  ->download();
  
  returns array of all downloaded fonts
  
  accepts callback function which is passed information on each font individually
    
### more:

  - PSR3 compatible loggers can be used
  
  ->setLogger(new \PSRCompatibleLogger());
  
  - run ->createFamilyCssFiles() 
  
  on unrecoverable errors to create Font Family CSS files that were successfully downloaded before the error occured (see example.php)
