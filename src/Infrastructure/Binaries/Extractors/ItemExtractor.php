<?php

namespace Albion\API\Infrastructure\Binaries\Extractors;

use Albion\API\Models\Location;
use DOMNode;

class ItemExtractor extends AbstractExtractor
{
    /**
     * @inheritDoc
     * @return mixed[]
     */
    public function extract(): array
    {
        $items = [];
        $elements = $this->xpath->query('/items/*[not(name()=\'shopcategories\')]');;

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