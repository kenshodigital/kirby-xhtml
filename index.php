<?php declare(strict_types=1);

namespace Kenshō\Templates;

use DOMDocument;
use Kirby\Cms\App;

/**
 * @noinspection PhpUnhandledExceptionInspection
 */
App::plugin('kenshodigital/templates-xml', [
    'hooks' => [
        Template::HOOK => function (string $output, string $type): string {
            if (\in_array($type, Xml::TYPES)) {
                $output = (new Xml(new DOMDocument))->process($output);
            }
            return $output;
        },
    ],
]);
