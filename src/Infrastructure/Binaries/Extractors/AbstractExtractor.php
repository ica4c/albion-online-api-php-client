<?php

namespace Albion\API\Infrastructure\Binaries\Extractors;

use DOMDocument;
use DOMElement;
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
     * @param DOMElement $element
     * @return array
     */
    protected function extractNodeAttributes(DOMElement $element) {
        $attributes = [];

        /** @var \DOMAttr $attribute */
        foreach ($element->attributes as $attribute) {
            if($attribute->value === 'true' || $attribute->value === 'false') {
                $value = (bool) $attribute->value;
            } elseif (is_float($attribute->value)) {
                $value = (float) $attribute->value;
            } elseif (is_int($attribute->value)) {
                $value = (int) $attribute->value;
            } else {
                $value = $attribute->value;
            }

            $attributes[$attribute->name] = $value;
        }

        return $attributes;
    }

    /**
     * @param DOMElement $element
     * @return array
     */
    protected function extractSubTree(DOMElement $element) {
        $attributes = $this->extractNodeAttributes($element);

        /** @var DOMElement $childNode */
        foreach ($element->childNodes as $childNode) {
            if($childNode->nodeType !== XML_ELEMENT_NODE) {
                continue;
            }

            if(array_key_exists($childNode->nodeName, $attributes)) {
                if(!is_numeric(key($attributes[$childNode->nodeName]))) {
                    $attributes[$childNode->nodeName] = [$attributes[$childNode->nodeName]];
                }

                $attributes[$childNode->nodeName][] = $this->extractSubTree($childNode);
            } else {
                $attributes[$childNode->nodeName] = $this->extractSubTree($childNode);
            }
        }

        return $attributes;
    }

    /**
     * Extracts information from document
     * @return array
     */
    abstract function extract(): array;
}