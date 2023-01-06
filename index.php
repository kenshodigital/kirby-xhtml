<?php declare(strict_types=1);

namespace Kenshō\Templates;

use DOMDocument;
use Kirby\Cms\App;

/**
 * @noinspection PhpUnhandledExceptionInspection
 */
App::plugin('kenshodigital/templates-xml', [
    'hooks' => [
        /**
         * Ensures well-formed output and
         * strips whitespace between nodes
         * for XML templates.
         */
        'page.render:after' => function (string $contentType, array $data, string $html): string {
            if (\in_array($contentType, Xml::TYPES)) {
                $html = (new Xml(new DOMDocument))->process($html);
            }
            return $html;
        },
    ],
]);
