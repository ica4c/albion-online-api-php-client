<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Binaries\Extractors;

class ItemExtractor extends AbstractExtractor
{
    public function extract(): array
    {
        $items = [];
        $elements = $this->xpath->query('/items/*[not(name()=\'shopcategories\')]');

        /** @var \DOMElement $element */
        foreach ($elements as $element) {
            $uniqueId = $element->getAttribute('uniquename');

            if(array_key_exists($uniqueId, $items)) {
                continue;
            }

            $items[$uniqueId] = $this->extractSubTree($element);
        }

        return $items;
    }
}
