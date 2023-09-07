<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use RuntimeException;
use Symfony\Component\DomCrawler\Crawler;

final class BulbapediaSexRatiosPage
{
    public static function fromFile(string $filename)
    {
        return new self(new Crawler(file_get_contents($filename)));
    }

    public function __construct(
        private readonly Crawler $page,
    ) {}

    public function extractSexRatios(): array
    {
        $node = $this->page->filter("#mw-content-text .mw-parser-output");

        $sections = [];
        $sectionIndex = 0;

        $node->children()->each(function (Crawler $node) use (&$sectionIndex, &$sections) {
            if ($node->matches("h2")) {
                $sectionIndex++;
                $sections[$sectionIndex] = [
                    'heading' => $node->text(),
                    'tables'  => [],
                ];
            } elseif ($node->matches("table table.sortable > tbody")) {
                $sections[$sectionIndex]['tables'][] = $node->filter("table table.sortable > tbody");
            }
        });

        $entries = [];

        foreach ($sections as $section) {
            if ($section['heading'] === "Trivia") {
                continue;
            }

            $ratio = match ($section['heading']) {
                "Male only"      => [
                    'male' => 1,
                ],
                "1 ♀ : 7 ♂"      => [
                    'female' => 1,
                    'male'   => 7,
                ],
                "1 ♀ : 3 ♂"      => [
                    'female' => 1,
                    'male'   => 3,
                ],
                "1 ♀ : 1 ♂"      => [
                    'female' => 1,
                    'male'   => 1,
                ],
                "3 ♀ : 1 ♂"      => [
                    'female' => 3,
                    'male'   => 1,
                ],
                "7 ♀ : 1 ♂"      => [
                    'female' => 7,
                    'male'   => 1,
                ],
                "Female only"    => [
                    'female' => 1,
                ],
                "Gender unknown" => [
                    'unknown' => 1,
                ],
                default          => throw new RuntimeException(),
            };

            foreach ($section['tables'] as $table) {
                $table->children()->each(function (Crawler $row) use (&$entries, $ratio) {
                    if ($row->matches("tr td")) {
                        $number = $row->children("td")->text();

                        if ($number === "0658"
                            && str_contains($row->text(), "Battle Bond")
                        ) {
                            return;
                        } elseif ($number === "0025"
                            && (
                                str_contains($row->text(), "cap forms")
                                || str_contains($row->text(), "Cosplay")
                            )
                        ) {
                            return;
                        } elseif ($number === "0172"
                            && str_contains($row->text(), "Spiky-eared")
                        ) {
                            return;
                        }

                        $entries[] = [
                            'number' => $number,
                            'ratio'  => $ratio,
                        ];
                    }
                });
            }
        }

        return $entries;
    }
}