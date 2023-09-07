<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\Commands\RegisterNewPokemonCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class RegisterNewPokemonCommand implements CommandInterface
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(string $pokedexNumber, ?string $form): void
    {
        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number AND form = :form", [
            'instanceId' => $this->instanceId->value,
            'number'     => $pokedexNumber,
            'form'       => $form,
        ]);

        if ($pokedexRow !== false) {
            return;
        }

        $this->db->insert("pokedex_entries", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'number'      => $pokedexNumber,
            'form'        => $form,
            'date_added'  => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ]);
    }
}
