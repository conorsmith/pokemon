<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use DOMDocument;
use DOMElement;
use DOMNode;

final class BulbapediaPokedexPage
{
    public static function fromFile(string $filename): self
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTMLFile($filename);

        libxml_clear_errors();

        return new self($dom);
    }

    public function __construct(
        private readonly DOMDocument $page,
    ) {}

    public function extractPokemonIds(): array
    {
        $titleNode = $this->page->getElementById("List_of_Pokémon_by_National_Pokédex_number");

        $tableNode = $titleNode->parentNode;

        $rawPokemonData = [];

        for ($i = 0; $i < 9; $i++) {
            $tableNode = $tableNode->nextSibling->nextSibling->nextSibling->nextSibling;

            if (!$tableNode instanceof DOMElement) {
                continue;
            }

            /** @var DOMNode $rowNode */
            foreach ($tableNode->getElementsByTagName("tr") as $rowNode) {
                $row = [];
                /** @var DOMNode $cellNode */
                foreach ($rowNode->childNodes as $cellNode) {
                    if ($cellNode->nodeName !== "td") {
                        continue;
                    }
                    $row[] = trim($cellNode->textContent);
                }

                if (count($row) !== 4 && count($row) !== 5) {
                    continue;
                }

                if ($row[0] === "") {
                    continue;
                }

                if ($row[0] === "#0000") {
                    continue;
                }

                $rawPokemonData[] = [
                    'number' => strval(intval(substr($row[0], 1))),
                    'name'   => $rowNode->childNodes->item(5)->childNodes->item(0)->textContent,
                ];
            }
        }

        return $rawPokemonData;
    }
}
