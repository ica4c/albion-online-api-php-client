<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Binaries\Extractors;

use DOMDocument;
use DOMElement;
use DOMXPath;

abstract class AbstractExtractor
{
    protected DOMXPath $xpath;

    protected function __construct(protected DOMDocument $dom)
    {
        $this->xpath = new DOMXPath($dom);
    }

    public static function make(DOMDocument $dom): static
    {
        /** @phpstan-ignore-next-line */
        return new static($dom);
    }

    /**
     * @return array<array-key, mixed>
     */
    protected function extractNodeAttributes(DOMElement $element): array
    {
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
     * @return array<array-key, mixed>
     */
    protected function extractSubTree(DOMElement $element): array
    {
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

    abstract public function extract(): array;
}
