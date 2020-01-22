<?php

/*
 * usage example
 */
require('src/gFontDownloader.php');

$host = $_SERVER['SERVER_NAME'] ? $_SERVER['SERVER_NAME'] : $_SERVER['SERVER_ADDR'];

$dl = new \smtws\Tools\Fonts\Google\gFontDownloader();

$dl->setConfig();
//$dl->setConfig(['output'=>getcwd(),'formats'=>['woff','woff2','svg']]);
//$dl->setLogger(new \PSRLogger());
$dl->addFont('Roboto', 'italic', ['400', 500]);
$dl->addFont('Roboto', 'normal', ['400', 500, 700]);
//$dl->addFontByUrl('https://fonts.google.com/?selection.family=Open+Sans:400,400i,600,600i,700i');
//$dl->addFontByUrl("https://fonts.googleapis.com/css?family=Gelasio:500i,700|Open+Sans|Roboto&display=swap");

try {
    $result = $dl->download(function($cb) {
        echo '<pre>' . print_r($cb, true) . '</pre>';
    });
} catch (\Exception $e) {
    echo $e->getMessage();
    $dl->createFamilyCssFiles();
}

echo '<pre>' . json_encode(formatOutput($result, $host), true) . '</pre>';

function formatOutput($fonts, $host = './') {
    $formated = array();
    if (is_array($fonts)) {
        foreach ($fonts as $fontFamily => $weights) {
            $key = count($formated);
            $formated[$key]['title'] = $fontFamily;
            $formated[$key]['path'] = '//' . $host . '/fonts/' . str_replace(' ', '_', $fontFamily) . '/font.css';
            $formated[$key]['bold'] = false;
            $formated[$key]['italic'] = false;
            $formated[$key]['bolditalic'] = false;
            foreach ($weights as $weight => $styles) {
                foreach (array_keys($styles) as $style) {
                    if ($style == 'italic') {
                        if ($weight == 700) {
                            $formated[$key]['bolditalic'] = true;
                        } else {
                            $formated[$key]['italic'] = true;
                        }
                    } else {
                        if ($weight == 700) {
                            $formated[$key]['bold'] = true;
                        }
                    }
                }
            }
        }
    }
    return $formated;
}
