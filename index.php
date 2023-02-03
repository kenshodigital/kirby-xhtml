<?php
/**
 * @noinspection PhpUnhandledExceptionInspection
 */
declare(strict_types=1);

namespace Kenshō\XHTML;

use DOMDocument;
use Kirby\Cms\App;

const XML = [
    'htm',
    'html',
    'rss',
    'xht',
    'xhtml',
    'xml',
    'xsl',
];
const XHTML = [
    'htm',
    'html',
    'xht',
    'xhtml',
];
App::plugin('kensho/xhtml', [
    'hooks' => [
        /**
         * Ensures well-formed XML and XHTML
         * output and strips whitespace between
         * nodes.
         */
        'page.render:after' => function (string $contentType, array $data, string $html): string {
            if (\in_array($contentType, XML)) {
                $document                     = new DOMDocument;
                $document->preserveWhiteSpace = FALSE;
                $document->loadXML($html);

                if (\in_array($contentType, XHTML)) {
                    App::instance()->response()->type('application/xhtml+xml');
                }
                return $document->saveXML();
            }
            return $html;
        },
    ],
]);
