<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\BulbapediaEncounter;
use DOMDocument;
use DOMNode;

final class BulbapediaLocationPage
{
    public static function fromFile(string $filename): self
    {
        $dom = new DOMDocument();
        $dom->loadHTMLFile($filename);
        return new self($dom);
    }

    public function __construct(
        private readonly DOMDocument $page,
    ) {}

    public function extractEncounters(): array
    {
        $titleNode = $this->page->getElementById("Pokémon");

        $tableNode = $titleNode->parentNode->nextSibling->nextSibling;

        $rawEncounterData = [];

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

            if (count($row) !== 4) {
                continue;
            }

            $rawEncounterData[] = new BulbapediaEncounter(
                $row[0],
                $row[1],
                $row[2],
                $row[3],
            );
        }

        return $rawEncounterData;
    }
}
