<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\ViewModels;

use ConorSmith\Pokemon\PokedexNo;

final class TeamMember
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $level
    ) {}

    public static function fromRows(array $rows, array $pokedex): array
    {
        $team = [];

        foreach ($rows as $row) {
            $team[] = new self(
                $row['id'],
                $pokedex[$row['pokemon_id']]['name'],
                self::createImageUrl($row['pokemon_id']),
                strval($row['level']),
            );
        }

        return $team;
    }

    public static function createImageUrl(string $id, ?string $form = null): string
    {
        if ($id === PokedexNo::UNOWN && !is_null($form)) {
            return self::createUnownImageUrl($form);
        }

        $paddedPokemonId = str_pad($id, 3, "0", STR_PAD_LEFT);
        return "https://assets.pokemon.com/assets/cms2/img/pokedex/full/{$paddedPokemonId}.png";
    }

    private static function createUnownImageUrl(string $form): string
    {
        return "/assets/forms/" .  match ($form) {
            "A" => "HOME0201.png",
            "B" => "HOME0201B.png",
            "C" => "HOME0201C.png",
            "D" => "HOME0201D.png",
            "E" => "HOME0201E.png",
            "F" => "HOME0201F.png",
            "G" => "HOME0201G.png",
            "H" => "HOME0201H.png",
            "I" => "HOME0201I.png",
            "J" => "HOME0201J.png",
            "K" => "HOME0201K.png",
            "L" => "HOME0201L.png",
            "M" => "HOME0201M.png",
            "N" => "HOME0201N.png",
            "O" => "HOME0201O.png",
            "P" => "HOME0201P.png",
            "Q" => "HOME0201Q.png",
            "R" => "HOME0201R.png",
            "S" => "HOME0201S.png",
            "T" => "HOME0201T.png",
            "U" => "HOME0201U.png",
            "V" => "HOME0201V.png",
            "W" => "HOME0201W.png",
            "X" => "HOME0201X.png",
            "Y" => "HOME0201Y.png",
            "Z" => "HOME0201Z.png",
            "!" => "HOME0201EX.png",
            "?" => "HOME0201QU.png",
        };
    }
}
