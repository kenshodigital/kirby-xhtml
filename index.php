<?php
/**
 * @noinspection PhpUnhandledExceptionInspection
 */
declare(strict_types=1);

namespace Kenshō\XHTML;

use DOMDocument;
use DOMImplementation;
use Kirby\Cms\App;

const HTML = [
    'htm',
    'html',
    'xht',
    'xhtml',
];
App::plugin('kensho/xhtml', [
    'hooks' => [
        /**
         * Ensures well-formed XHTML output and
         * removes whitespace between nodes.
         */
        'page.render:after' => function (string $contentType, array $data, string $html): string {
            if (\in_array($contentType, HTML)) {
                $dom                          = new DOMImplementation;
                $doctype                      = $dom->createDocumentType('html');
                $document                     = $dom->createDocument(null, '', $doctype);
                $document->xmlVersion         = '1.0';
                $document->encoding           = 'utf-8';
                $fragment                     = $document->createDocumentFragment();
                $fragment->appendXML($html);
                $document->appendChild($fragment);
                $xml                          = $document->saveXML();
                $document                     = new DOMDocument('1.0', 'utf-8');
                $document->preserveWhiteSpace = false;
                $document->loadXML($xml);

                App::instance()->response()->type('application/xhtml+xml');

                return $document->saveXML();
            }
            return $html;
        },
    ],
]);
