<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ConorSmith\Pokemon\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use Exception;
use ReflectionClass;
use Symfony\Component\DomCrawler\Crawler;

final class BulbapediaPokemonPage
{
    public static function fromPokedexNumber(PokedexNumber $pokedexNumber): self
    {
        $filename = __DIR__ . "/../../.cache/pokemon/" . str_pad($pokedexNumber->value, 4, "0", STR_PAD_LEFT) . ".html";

        if (!file_exists($filename)) {
            $reflector = new ReflectionClass(PokedexNumberConstants::class);
            $constants = array_flip($reflector->getConstants());

            $name = $constants[$pokedexNumber->value];

            $name = match ($name) {
                default => ucfirst(strtolower($name)),
                "NIDORAN_F" => "Nidoran♀",
                "NIDORAN_M" => "Nidoran♂",
                "FARFETCH_D" => "Farfetch'd",
                "MR_MIME" => "Mr._Mime",
                "HO_OH" => "Ho-Oh",
            };

            $url = "https://bulbapedia.bulbagarden.net/wiki/{$name}_(Pok%C3%A9mon)";

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
        return new self(new Crawler(file_get_contents($filename)));
    }

    public function __construct(
        private readonly Crawler $page,
    ) {}

    public function extractPokemonSpecies(): array
    {
        $summaryTable = $this->page->filter("#mw-content-text table.roundy");

        $name = $summaryTable->filter("big > big > b")->text();

        $typesRow = $summaryTable->children("tbody > tr:nth-child(2) > td > table > tbody > tr > td > table > tbody > tr")->first();

        $types = $typesRow->children("td")->each(fn($node) => $node->text());

        $types = array_filter($types, fn($type) => $type !== "Unknown");

        $baseFriendshipCell = $summaryTable->filter("a[title='List of Pokémon by base friendship']")->ancestors()->nextAll()->filter("td");

        return [
            'pokedexNumber' => strval(intval(substr($summaryTable->filter("big > big > a > span")->text(), 1))),
            'name' => $name,
            'types' => $types,
            'evolutions' => $this->extractEvolutions(),
            'friendship' => $baseFriendshipCell->text(),
        ];
    }

    private function extractEvolutions(): array
    {
        $evolutionTable = $this->page->filter("#Evolution")->ancestors()->nextAll();

        // Heading is followed by a subheading for a regional variant
        if ($evolutionTable->nodeName() !== "table") {
            $evolutionTable = $evolutionTable->nextAll();
        }

        $evolutionTable = $evolutionTable->first();

        $pokemonCell = $evolutionTable->filter("td .selflink")->ancestors()->ancestors()->ancestors()->ancestors()->ancestors();

        if ($pokemonCell->children()->filter(".selflink span")->text() === "Eevee") {
            return self::eeveeEvolutions();
        }

        $evolutionMethodCell = $pokemonCell->nextAll();

        if ($evolutionMethodCell->count() === 0) {
            return [];
        }

        if ($pokemonCell->attr("rowspan") > 1
            && is_null($evolutionMethodCell->attr("rowspan"))
            && $evolutionTable->children()->children()->count() > 1 // Check for tables with erroneous rowspan attributes
        ) {
            $evolutionCount = intval($pokemonCell->attr("rowspan"));
        } else {
            $evolutionCount = 1;
        }

        $evolutions = [];

        for ($i = 0; $i < $evolutionCount; $i++) {

            if ($i > 0) {
                $tableRow = $evolutionTable->children()->children()->slice($i);
                $evolutionMethodCell = $tableRow->children()->first();
            }

            $evolutionTargetCell = $evolutionMethodCell->nextAll();

            $name = $evolutionTargetCell->filter("tr:nth-child(3) > td > a > span")->text();

            if ($evolutionMethodCell->filter("a[title='Level'] > span")->count() > 0) {
                $level = str_replace("Level ", "", $evolutionMethodCell->filter("a[title='Level'] > span")->text());

                if ($level === "Level") {
                    $level = trim($evolutionMethodCell->filter("a[title='Level']")->ancestors()->getNode(0)->childNodes->item(5)->textContent);
                }

                if (is_numeric($level)) {
                    if ($evolutionMethodCell->filter("a[title='Power Bracer']")->count() === 1) {
                        $evolutions[] = [
                            'name'  => $name,
                            'level' => $level,
                            'stats' => "Physical Attack > Physical Defence",
                        ];
                        continue;
                    }

                    if ($evolutionMethodCell->filter("a[title='Power Belt']")->count() === 1) {
                        $evolutions[] = [
                            'name'  => $name,
                            'level' => $level,
                            'stats' => "Physical Attack < Physical Defence",
                        ];
                        continue;
                    }

                    if ($evolutionMethodCell->filter("a[title='Macho Brace']")->count() === 1) {
                        $evolutions[] = [
                            'name'  => $name,
                            'level' => $level,
                            'stats' => "Physical Attack = Physical Defence",
                        ];
                        continue;
                    }

                    if (str_contains($evolutionMethodCell->text(), "with a certainpersonality value")) {
                        $evolutions[] = [
                            'name'  => $name,
                            'level' => $level,
                            'randomly' => true,
                        ];
                        continue;
                    }

                    $evolutions[] = [
                        'name'  => $name,
                        'level' => $level,
                    ];
                    continue;
                }

                $levels = explode("/", $level);

                if (array_reduce($levels, fn($carry, $level) => $carry && is_numeric($level), true)) {
                    $evolutions[] = [
                        'name'  => $name,
                        'level' => $levels[0],
                    ];
                    continue;
                }

                if ($evolutionMethodCell->filter("a[title='Friendship'] > span")->count() > 0) {
                    $evolutions[] = [
                        'name'       => $name,
                        'friendship' => true,
                    ];
                    continue;
                }

                if (str_contains($evolutionMethodCell->filter("a[title='Level']")->ancestors()->text(), "after using")
                    || str_contains($evolutionMethodCell->filter("a[title='Level']")->ancestors()->text(), "knowing")
                ) {
                    $evolutions[] = [
                        'name' => $name,
                        'move' => $evolutionMethodCell->filter("a[title='Level']")->nextAll()->nextAll()->text(),
                    ];
                    continue;
                }

                if (str_contains($evolutionMethodCell->filter("a[title='Level']")->ancestors()->text(), "holding")
                ) {
                    if ($evolutionMethodCell->filter("a[title='Level']")->nextAll()->nextAll()->text() === "Beauty") {
                        $evolutions[] = self::feebasEvolution();
                        continue;
                    }
                    if ($evolutionMethodCell->filter("a[title='Time'] > span")->count() > 0) {
                        $evolutions[] = [
                            'name'    => $name,
                            'holding' => $evolutionMethodCell->filter("a[title='Level']")->nextAll()->nextAll()->text(),
                            'time'    => $evolutionMethodCell->filter("a[title='Time'] > span")->text(),
                        ];
                        continue;
                    }
                    $evolutions[] = [
                        'name' => $name,
                        'holding' => $evolutionMethodCell->filter("a[title='Level']")->nextAll()->nextAll()->text(),
                    ];
                    continue;
                }
            }

            if ($evolutionMethodCell->filter("a[title='Move mastery'] > span")->count() > 0) {
                $evolutions[] = [
                    'name' => $name,
                    'move' => str_replace(" (move)", "", $evolutionMethodCell->filter("a[title='Move mastery']")->nextAll()->attr("title")),
                ];
                continue;
            }

            $itemIdsByLinkTitle = [
                "Dawn Stone"     => ItemId::DAWN_STONE,
                "Dusk Stone"     => ItemId::DUSK_STONE,
                "Fire Stone"     => ItemId::FIRE_STONE,
                "Leaf Stone"     => ItemId::LEAF_STONE,
                "Ice Stone"      => ItemId::ICE_STONE,
                "Moon Stone"     => ItemId::MOON_STONE,
                "Shiny Stone"    => ItemId::SHINY_STONE,
                "Sun Stone"      => ItemId::SUN_STONE,
                "Thunder Stone"  => ItemId::THUNDER_STONE,
                "Water Stone"    => ItemId::WATER_STONE,
                "Black Augurite" => ItemId::BLACK_AUGURITE,
                "Deep Sea Scale" => ItemId::DEEP_SEA_SCALE,
                "Deep Sea Tooth" => ItemId::DEEP_SEA_TOOTH,
                "Dragon Scale"   => ItemId::DRAGON_SCALE,
                "Dubious Disc"   => ItemId::DUBIOUS_DISC,
                "Electirizer"    => ItemId::ELECTIRIZER,
                "King\'s Rock"   => ItemId::KINGS_ROCK,
                "Linking Cord"   => ItemId::LINKING_CORD,
                "Magmarizer"     => ItemId::MAGMARIZER,
                "Metal Coat"     => ItemId::METAL_COAT,
                "Peat Block"     => ItemId::PEAT_BLOCK,
                "Prism Scale"    => ItemId::PRISM_SCALE,
                "Protector"      => ItemId::PROTECTOR,
                "Reaper Cloth"   => ItemId::REAPER_CLOTH,
                "Upgrade"        => ItemId::UPGRADE,
            ];

            $addedAnEvolution = false;

            foreach ($itemIdsByLinkTitle as $linkTitle => $itemId) {
                if ($evolutionMethodCell->children()->filter("a[title='{$linkTitle}'] > span")->count() > 0) {
                    if (str_contains($evolutionMethodCell->text(), "during a full moon")) {
                        $evolutions[] = [
                            'name' => $name,
                            'item' => $itemId,
                            'time' => "Full Moon",
                        ];
                    } elseif ($evolutionMethodCell->filter("a[title='Gender'] img")->count() > 0) {
                        preg_match(
                            "/\w+/",
                            $evolutionMethodCell->filter("a[title='Gender'] img")->attr("alt"),
                            $matches,
                        );
                        $evolutions[] = [
                            'name' => $name,
                            'item' => $itemId,
                            'gender' => strtolower($matches[0]),
                        ];
                    } else {
                        $evolutions[] = [
                            'name' => $name,
                            'item' => $itemId,
                        ];
                    }
                    $addedAnEvolution = true;
                }
            }

            if ($addedAnEvolution) {
                continue;
            }

            throw new Exception;
        }

        $evolutionHashes = [];

        foreach ($evolutions as $i => $evolution) {
            $evolutionHash = md5(http_build_query($evolution));
            if (in_array($evolutionHash, $evolutionHashes)) {
                unset($evolutions[$i]);
            } else {
                $evolutionHashes[] = $evolutionHash;
            }
        }

        return $evolutions;
    }

    private static function eeveeEvolutions(): array
    {
        return [
            [
                'name' => "Vaporeon",
                'item' => ItemId::WATER_STONE,
            ],
            [
                'name' => "Jolteon",
                'item' => ItemId::THUNDER_STONE,
            ],
            [
                'name' => "Flareon",
                'item' => ItemId::FIRE_STONE,
            ],
            [
                'name' => "Espeon",
                'friendship' => true,
                'time' => "day",
            ],
            [
                'name' => "Umbreon",
                'friendship' => true,
                'time' => "night",
            ],
            [
                'name' => "Leafeon",
                'item' => ItemId::LEAF_STONE,
            ],
            [
                'name' => "Glaceon",
                'item' => ItemId::ICE_STONE,
            ],
            [
                'name' => "Sylveon",
                'friendship' => true,
                'move' => PokemonType::FAIRY,
            ],
        ];
    }

    private static function feebasEvolution(): array
    {
        return [
            'name' => "Milotic",
            'item' => ItemId::PRISM_SCALE,
        ];
    }
}