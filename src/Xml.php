<?php declare(strict_types=1);

namespace Kenshō\Templates;

use DOMDocument;

/**
 * Ensures well-formed XML output and
 * strips whitespace between nodes.
 */
class Xml implements Processor
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

    public function __construct(
        private readonly DOMDocument $document
    ) {
        $this->document->preserveWhiteSpace = FALSE;
    }

    public function process(string $output): string
    {
        $this->document->loadXML($output);

        return $this->document->saveXML();
    }
}
