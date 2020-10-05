<?php

namespace Albion\API\Infrastructure\Binaries\Extractors;

use DOMDocument;
use DOMNode;
use DOMXPath;

abstract class AbstractExtractor
{
    /** @var \DOMDocument */
    protected $dom;
    /** @var \DOMXPath */
    protected $xpath;

    /**
     * AbstractExtractor constructor.
     *
     * @param DOMDocument $dom
     */
    public function __construct(DOMDocument $dom)
    {
        $this->dom = $dom;
        $this->xpath = new DOMXPath($dom);
    }

    /**
     * Extracts information from document
     * @return array
     */
    abstract function extract(): array;
}