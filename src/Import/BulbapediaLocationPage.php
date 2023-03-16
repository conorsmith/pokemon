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
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTMLFile($filename);

        libxml_clear_errors();

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

    public function extractTrainers(): array
    {
        $titleNode = $this->page->getElementById("Trainers");

        $tableNode = $titleNode->parentNode->nextSibling->nextSibling;

        $rawTrainerData = [];

        $trainerCount = 0;

        /** @var DOMNode $rowNode */
        foreach ($tableNode->childNodes->item(1)->childNodes as $rowNode) {
            if (trim($rowNode->textContent) === "Rematch") {
                break;
            }

            $row = [];
            /** @var DOMNode $cellNode */
            foreach ($rowNode->childNodes as $cellNode) {
                if ($cellNode->nodeName !== "td") {
                    continue;
                }

                if ($cellNode->attributes->getNamedItem("rowspan")) {
                    $trainerCell = $cellNode->childNodes->item(1)
                        ->childNodes->item(1)
                        ->childNodes->item(2)
                        ->childNodes->item(3)
                        ->childNodes->item(0);

                    $trainerCount++;
                    $rawTrainerData[$trainerCount] = [
                        'trainer' => [
                            'class' => $trainerCell->childNodes->item(0)->textContent,
                            'name' => trim($trainerCell->childNodes->item(1)->textContent),
                        ],
                        'pokemon' => [],
                    ];
                } else {
                    $pokemonRow = $cellNode
                        ->childNodes->item(1)
                        ->childNodes->item(1)
                        ->childNodes->item(0);

                    $rawTrainerData[$trainerCount]['pokemon'][] = [
                        'name' => $pokemonRow
                            ->childNodes->item(3)
                            ->childNodes->item(0)
                            ->textContent,
                        'sex' => trim($pokemonRow
                            ->childNodes->item(3)
                            ->childNodes->item(1)
                            ->textContent),
                        'level' => $pokemonRow
                            ->childNodes->item(5)
                            ->childNodes->item(0)
                            ->childNodes->item(1)
                            ->textContent,
                    ];
                }
            }
        }

        return $rawTrainerData;
    }
}
