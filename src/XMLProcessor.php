<?php declare(strict_types=1);

namespace Kenshō\XHTML;

use DOMDocument;

/**
 * Ensures well-formed XML and XHTML
 * output and strips whitespace between
 * nodes.
 */
readonly class XMLProcessor
{
    public const TYPES = [
        'htm',
        'html',
        'rss',
        'xht',
        'xhtml',
        'xml',
        'xsl',
    ];

    private const XML_DECLARATION = '<?xml version="1.0" encoding="utf-8"?>';

    public function __construct(
        private readonly DOMDocument $document
    ) {
        $this->document->preserveWhiteSpace = FALSE;
    }

    public function process(string $output): string
    {
        $this->document->loadXML(self::XML_DECLARATION . $output);

        return $this->document->saveXML();
    }
}
