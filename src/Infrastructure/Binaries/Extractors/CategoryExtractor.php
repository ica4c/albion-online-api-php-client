<?php

namespace Albion\API\Infrastructure\Binaries\Extractors;

use DOMElement;

class CategoryExtractor extends AbstractExtractor
{
    /**
     * @inheritDoc
     * @param \DOMElement $node
     *
     * @return array
     */
    protected function extractFromElement(DOMElement $node): array {
        $id = $node->getAttribute('id');
        $value = $node->getAttribute('value');

        $children = [];

        foreach ($node->getElementsByTagName('shopsubcategory') as $subCategoryNode) {
            $children[] = $this->extractFromElement($subCategoryNode);
        }

        return [
            'id' => $id,
            'value' => $value,
            'children' => $children
        ];
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function extract(): array
    {
        $categories = [];

        /** @var \DOMElement $categoryNode */
        foreach ($this->xpath->query('/items/shopcategories/shopcategory') as $categoryNode) {
            $categories[] = $this->extractFromElement($categoryNode);
        }

        return $categories;
    }
}