<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\BulbapediaEncounter;
use DOMDocument;
use DOMNode;
use DOMNodeList;
use Exception;

final class BulbapediaLocationPage
{
    public static function fromUrl(string $url): self
    {
        $filename = __DIR__ . "/../../.cache/location/" . md5($url) . ".html";

        if (!file_exists($filename)) {

            $page = file_get_contents($url);

            if ($page === false || strlen($page) < 1000) {
                throw new Exception;
            }

            file_put_contents($filename, $page);
        }

        return self::fromFile($filename);
    }

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

    public function extractEncounters(?string $sectionTitle): array
    {
        $titleNode = $this->page->getElementById("Pokémon");

        $possibleTableNode = $titleNode->parentNode->nextSibling->nextSibling;

        $rawEncounterData = [];

        $mostRecentSubtitle = "Default";
        $mostRecentSubSubtitle = "";
        $currentNode = $possibleTableNode;

        while (!is_null($currentNode)) {
            if ($currentNode->nodeName === "table") {
                if (is_null($sectionTitle)
                    || $mostRecentSubtitle . $mostRecentSubSubtitle === $sectionTitle
                    || $mostRecentSubtitle . $mostRecentSubSubtitle === "Default" . $sectionTitle
                ) {
                    $rawEncounterData[$mostRecentSubtitle . $mostRecentSubSubtitle] = array_merge(
                        $rawEncounterData[$mostRecentSubtitle . $mostRecentSubSubtitle] ?? [],
                        self::extractEncountersFromTableNode($currentNode),
                    );
                }
            } elseif ($currentNode->nodeName === "h3") {
                $mostRecentSubtitle = $currentNode->textContent;
            } elseif ($currentNode->nodeName === "h4") {
                $mostRecentSubSubtitle = $currentNode->textContent;
            } elseif ($currentNode->nodeName === "h2") {
                break;
            }
            $currentNode = $currentNode->nextSibling;
        }

        return $rawEncounterData;
    }

    private static function extractEncountersFromTableNode(DOMNode $tableNode): array
    {
        $rawEncounterData = [];

        /** @var DOMNode $rowNode */
        foreach ($tableNode->getElementsByTagName("tr") as $rowNode) {
            $row = [];
            /** @var DOMNode $cellNode */
            foreach ($rowNode->childNodes as $i => $cellNode) {
                if ($cellNode->nodeName !== "td") {
                    continue;
                }

                /** @var DOMNodeList $spanNodes */
                $spanNodes = $cellNode->getElementsByTagName("span");

                if ($i > 1 || $spanNodes->length === 0) {
                    $row[] = trim($cellNode->textContent);
                    continue;
                }

                $row[] = trim($spanNodes->item(0)->textContent);
                if ($spanNodes->length === 2) {
                    $row[] = trim($spanNodes->item(1)->textContent);
                } else {
                    $row[] = null;
                }
            }

            if (count($row) !== 5 && count($row) !== 7) {
                continue;
            }

            if (in_array($row[0], ["", "Surf", "Walking", "Waterside", "Good Rod", "Super Rod"])) {
                continue;
            }

            $rawEncounterData[] = new BulbapediaEncounter(
                $row[0],
                $row[1],
                $row[2],
                $row[3],
                count($row) === 5
                    ? $row[4]
                    : [$row[4], $row[5], $row[6]],
            );
        }

        return $rawEncounterData;
    }

    public function extractTrainers(?string $sectionTitle): array
    {
        $titleNode = $this->page->getElementById("Trainers");

        $possibleTableNode = $titleNode->parentNode->nextSibling->nextSibling;

        $rawTrainerData = [];

        $mostRecentSubtitle = "Default";
        $currentNode = $possibleTableNode;

        while (!is_null($currentNode)) {
            if ($currentNode->nodeName === "table") {
                if (is_null($sectionTitle)
                    || $mostRecentSubtitle === $sectionTitle
                ) {
                    $rawTrainerData[$mostRecentSubtitle] = array_merge(
                        $rawTrainerData[$mostRecentSubtitle] ?? [],
                        self::extractTrainersFromTableNode($currentNode),
                    );
                }
            } elseif ($currentNode->nodeName === "h3"
                || $currentNode->nodeName === "h4"
            ) {
                if ($currentNode->textContent === "Layout"
                    || $currentNode->textContent === "Items"
                ) {
                    break;
                }
                $mostRecentSubtitle = $currentNode->textContent;
            } elseif ($currentNode->nodeName === "h2") {
                break;
            }
            $currentNode = $currentNode->nextSibling;
        }

        return $rawTrainerData;
    }

    private static function extractTrainersFromTableNode(DOMNode $tableNode): array
    {
        $trainerCount = 0;
        $rawTrainerData = [];

        if ($tableNode->attributes->getNamedItem("class")->nodeValue === "expandable") {
            $trainerRowNodes = $tableNode
                ->firstChild->nextSibling
                ->firstChild
                ->firstChild->nextSibling
                ->firstChild->nextSibling
                ->firstChild->nextSibling
                ->firstChild
                ->firstChild->nextSibling->nextSibling->nextSibling
                ->firstChild->nextSibling
                ->firstChild->nextSibling
                ->childNodes;

            if (trim($trainerRowNodes->item(0)->textContent) === "") {
                $classNodeIndex = 2;
                //dd($trainerRowNodes->item(1)->ownerDocument->saveHTML($trainerRowNodes->item(2)));
            } else {
                $classNodeIndex = 0;
            }

            $classNode = $trainerRowNodes->item($classNodeIndex)
                ->firstChild->nextSibling
                ->firstChild
                ->firstChild
                ->firstChild;

            $nameNode = $trainerRowNodes->item(2)
                ->firstChild->nextSibling
                ->firstChild
                ->firstChild
                ->firstChild
                ->firstChild;

            $class = substr(
                $classNode->attributes->getNamedItem("title")->nodeValue,
                0,
                strlen(" (Trainer class)") * -1,
            );
            if ($class === "") {
                $class = $classNode->attributes->getNamedItem("title")->nodeValue;
            }

            $trainerCount++;
            $rawTrainerData[$trainerCount] = [
                'trainer' => [
                    'class' => $class,
                    'gender' => null,
                    'name'  => is_null($nameNode) ? "" : trim($nameNode->textContent),
                ],
                'pokemon' => [],
            ];

            $rowNodes = $tableNode
                ->firstChild->nextSibling
                ->firstChild->nextSibling->nextSibling
                ->firstChild->nextSibling
                ->firstChild->nextSibling
                ->firstChild->nextSibling
                ->childNodes;

            foreach ($rowNodes as $rowNode) {
                /** @var DOMNode $cellNode */
                foreach ($rowNode->childNodes as $cellNode) {
                    if ($cellNode->nodeName !== "td") {
                        continue;
                    }

                    $pokemonNode = $cellNode
                        ->firstChild->nextSibling
                        ->firstChild->nextSibling
                        ->firstChild->nextSibling->nextSibling
                        ->firstChild->nextSibling;

                    preg_match("/(\w+)([♀♂]?)\sLv.(\d+)/u", $pokemonNode->textContent, $matches);

                    $rawTrainerData[$trainerCount]['pokemon'][] = [
                        'name'  => $matches[1],
                        'sex'   => $matches[2],
                        'level' => $matches[3],
                    ];
                }
            }
        } else {

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

                    if (is_null($cellNode->childNodes->item(1))) {
                        continue;
                    }

                    if ($cellNode->attributes->getNamedItem("rowspan")) {
                        $trainerCell = $cellNode->childNodes->item(1)
                            ->childNodes->item(1)
                            ->childNodes->item(2)
                            ->childNodes->item(3)
                            ->childNodes->item(0);

                        $className = $trainerCell->childNodes->item(0)->textContent;

                        if ($className === "Swimmer") {
                            $imageNode = $cellNode->childNodes->item(1)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(0);

                            $imageUrl = $imageNode->attributes->getNamedItem("src")->nodeValue;

                            preg_match("/(FRLG|Spr_RS)_Swimmer_(\w)/", $imageUrl, $matches);

                            $gender = $matches[2];
                        } elseif ($className === "Pokémon Ranger") {
                            $imageNode = $cellNode->childNodes->item(1)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(0);

                            $imageUrl = $imageNode->attributes->getNamedItem("src")->nodeValue;

                            preg_match("/_Pok%C3%A9mon_Ranger_(\w)/", $imageUrl, $matches);

                            $gender = $matches[1];
                        } elseif ($className === "Cooltrainer") {
                            $imageNode = $cellNode->childNodes->item(1)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(0);

                            $imageUrl = $imageNode->attributes->getNamedItem("src")->nodeValue;

                            preg_match("/_Cooltrainer_(\w)/", $imageUrl, $matches);

                            $gender = $matches[1];
                        } else {
                            $imageNode = $cellNode->childNodes->item(1)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(1)
                                ->childNodes->item(0)
                                ->childNodes->item(0);

                            $imageUrl = $imageNode->attributes->getNamedItem("src")->nodeValue;

                            $foundMatch = preg_match("/_([MF])\./", $imageUrl, $matches);

                            if ($foundMatch === 1) {
                                $gender = $matches[1];
                            } else {
                                $gender = null;
                            }
                        }

                        $trainerCount++;
                        $rawTrainerData[$trainerCount] = [
                            'trainer' => [
                                'class' => $trainerCell->childNodes->item(0)->textContent,
                                'gender' => $gender,
                                'name'  => trim($trainerCell->childNodes->item(1)->textContent),
                            ],
                            'pokemon' => [],
                        ];
                    } elseif ($cellNode->childNodes->item(1)->nodeName !== "#text") {

                        if (is_null($cellNode
                            ->childNodes->item(1)
                            ->childNodes->item(1)
                            ->childNodes)
                        ) {
                            continue;
                        }

                        $pokemonRow = $cellNode
                            ->childNodes->item(1)
                            ->childNodes->item(1)
                            ->childNodes->item(0);

                        if (is_null($pokemonRow
                            ->childNodes->item(5)
                            ->childNodes)
                        ) {
                            continue;
                        }

                        $rawTrainerData[$trainerCount]['pokemon'][] = [
                            'name'  => $pokemonRow
                                ->childNodes->item(3)
                                ->childNodes->item(0)
                                ->textContent,
                            'sex'   => trim($pokemonRow
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
        }

        return $rawTrainerData;
    }
}
