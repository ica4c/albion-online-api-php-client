<?php

namespace Albion\API\Infrastructure\Binaries\Extractors;

class LocalizationExtractor extends AbstractExtractor
{
    /**
     * @inheritDoc
     * @return string[][]
     */
    public function extract(): array
    {
        $map = [];

        /** @var \DOMElement $string */
        foreach ($this->xpath->query('//body//tu') as $string) {
            $key = (string) $string->getAttribute('tuid');

            /** @var \DOMElement $locale */
            foreach ($string->getElementsByTagName('tuv') as $locale) {
                $localeId = $locale->getAttribute('xml:lang');
                $translation = $locale->getElementsByTagName('seg');

                if(!array_key_exists($localeId, $map)) {
                    $map[$localeId] = [];
                }

                $map[$localeId][$key] = $translation->item(0)->textContent;
            }
        }

        return $map;
    }
}