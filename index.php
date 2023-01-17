<?php declare(strict_types=1);

namespace Kenshō\XHTML;

use DOMDocument;
use Kirby\Cms\App;

App::plugin('kensho/xhtml', [
    'hooks' => [
        'page.render:after' => function (string $contentType, array $data, string $html): string {
            if (\in_array($contentType, XMLProcessor::TYPES)) {
                $html = (new XMLProcessor(new DOMDocument))->process($html);
            }
            return $html;
        },
    ],
]);
