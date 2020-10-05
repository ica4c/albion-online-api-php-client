<?php

namespace Albion\API\Infrastructure\Binaries\Extractors;

use Albion\API\Models\Location;
use DOMNode;

class ItemExtractor extends AbstractExtractor
{
    /**
     * @inheritDoc
     * @param \DOMNode $node
     */
    protected function extractItem(DOMNode $node): array {
        /**
         * Possible items:
         * hideoutitem, farmableitem, simpleitem, consumableitem,
         * consumablefrominventoryitem, equipmentitem, weapon,
         * mount, furnitureitem, journalitem, labourercontract,
         * mountskin, crystalleagueitem
         */
        $category = str_replace('item', '', $node->nodeName);
        $parameters = [];
        $attributes = [];

        for ($i = 0; $i < $node->attributes->length; $i++) {
            $attribute = $node->attributes->item($i);

            if(!$attribute) {
                continue;
            }

            $attributes[$attribute->nodeName] = $attribute->textContent;
        }

        switch ($category) {
            case 'hideout':
                break;

            case 'farmable':
                break;

            case 'simple':
                break;

            case 'consumable':
                break;

            case 'consumablefrominventory':
                break;

            case 'equipment':
                break;

            case 'weapon':
                break;

            case 'mount':
                break;

            case 'furniture':
                break;

            case 'journal':
                break;

            case 'labourercontract':
                break;

            case 'mountskin':
                break;

            case 'crystalleague':
                break;
        }

        return [
//            'category' => ,
        ]
            + $attributes;
    }

    /**
     * @inheritDoc
     * @return mixed[]
     */
    public function extract(): array
    {
        $items = [];
        $elements = $this->xpath->query('/items/*[not(name()=\'shopcategories\')]');

        foreach ($elements as $element) {
            if(!in_array($element->nodeName, $items)) {
                $items[] = $element->nodeName;
            }

//            $items[] = $this->extractItem($element);
        }

//        var_dump($items); exit;

//        return $items;
        return [];
    }

}