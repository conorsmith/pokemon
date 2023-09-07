<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use Exception;
use Symfony\Component\DomCrawler\Crawler;

final class BulbapediaEvsPage
{
    public static function fromFile(string $filename)
    {
        return new self(new Crawler(file_get_contents($filename)));
    }

    public function __construct(
        private readonly Crawler $page,
    ) {}

    public function extractEvs(): array
    {
        $table = $this->page->filter("#mw-content-text table.sortable > tbody");

        $entries = [];

        $table->children("tr")->each(function (Crawler $row) use (&$entries) {
            if ($row->children("td")->count() === 0) {
                return;
            }

            $entry = [];
            $isValidEntry = true;

            $row->children("td")->each(function (Crawler $cell, int $index) use (&$entry, &$isValidEntry) {
                if ($index === 2) {
                    $subscript = $cell->filter("small");
                    if ($subscript->count() !== 0 && $subscript->text() !== "") {
                        if (preg_match("/^Mega /", $subscript->text()) === 1
                            || preg_match("/^Partner$/", $subscript->text()) === 1
                            || preg_match("/^Primal Reversion$/", $subscript->text()) === 1
                            || preg_match("/^Standard Mode$/", $subscript->text()) === 1
                            || preg_match("/^Zen Mode$/", $subscript->text()) === 1
                            || preg_match("/^Ash-Greninja$/", $subscript->text()) === 1
                            || preg_match("/^Eternal Flower$/", $subscript->text()) === 1
                            || preg_match("/^Eternamax$/", $subscript->text()) === 1
                        ) {
                            $isValidEntry = false;
                            return;
                        } elseif (preg_match("/^(.*) Form(e?)(s?)(Zen Mode)?$/", $subscript->text(), $matches) === 1) {
                            $entry['form'] = $matches[1];
                            return;
                        } elseif (preg_match("/^.* Cloak$/", $subscript->text()) === 1
                            || preg_match("/^.* Rotom$/", $subscript->text()) === 1
                            || preg_match("/^.* Kyurem$/", $subscript->text()) === 1
                            || preg_match("/^Hoopa .*$/", $subscript->text()) === 1
                            || preg_match("/^Dusk Mane$/", $subscript->text()) === 1
                            || preg_match("/^Dawn Wings$/", $subscript->text()) === 1
                            || preg_match("/^Ultra Necrozma$/", $subscript->text()) === 1
                            || preg_match("/^Male$/", $subscript->text()) === 1
                            || preg_match("/^Female$/", $subscript->text()) === 1
                            || preg_match("/^Hero of Many Battles$/", $subscript->text()) === 1
                            || preg_match("/^Crowned .*$/", $subscript->text()) === 1
                            || preg_match("/^.* Rider$/", $subscript->text()) === 1
                        ) {
                            $entry['form'] = $subscript->text();
                            return;
                        } else {
                            throw new Exception("Unhandled variant '{$subscript->text()}'");
                        }
                    }
                }

                $entryKey = match ($index) {
                    0       => 'pokedexNumber',
                    3       => 'exp',
                    4       => 'hp',
                    5       => 'physicalAttack',
                    6       => 'physicalDefence',
                    7       => 'specialAttack',
                    8       => 'specialDefence',
                    9       => 'speed',
                    default => null,
                };

                if (is_null($entryKey)) {
                    return;
                }

                $entry[$entryKey] = $cell->text();
            });

            if ($isValidEntry) {
                $entries[] = $entry;
            }
        });

        return $entries;
    }
}