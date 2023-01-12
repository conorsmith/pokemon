<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\ViewModels;

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
                $pokedex[$row['pokemon_id']]['imageUrl'],
                strval($row['level']),
            );
        }

        return $team;
    }
}
