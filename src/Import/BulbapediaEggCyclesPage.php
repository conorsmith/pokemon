<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use Symfony\Component\DomCrawler\Crawler;

final class BulbapediaEggCyclesPage
{
    public static function fromFile(string $filename)
    {
        return new self(new Crawler(file_get_contents($filename)));
    }

    public function __construct(
        private readonly Crawler $page,
    ) {}

    public function extractEggGroupsAndEggCycles(): array
    {
        $table = $this->page->filter("#mw-content-text table.sortable > tbody");

        $entries = [];

        $table->children("tr")->each(function (Crawler $row) use (&$entries) {
            if ($row->children("td")->count() === 0) {
                return;
            }

            $entry = [];

            $row->children("td")->each(function (Crawler $cell, int $index) use (&$entry) {

                $entryKey = match ($index) {
                    0       => 'pokedexNumber',
                    3       => 'group1',
                    4       => 'group2',
                    5       => 'cycles',
                    default => null,
                };

                if (is_null($entryKey)) {
                    return;
                }

                $entry[$entryKey] = $cell->text();
            });

            $entries[] = $entry;
        });

        return $entries;
    }
}
