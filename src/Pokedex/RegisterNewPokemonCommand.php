<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\RegisterNewPokemonCommand as CommandInterface;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class RegisterNewPokemonCommand implements CommandInterface
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function run(string $pokedexNumber, ?string $form): void
    {
        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number AND form = :form", [
            'instanceId' => INSTANCE_ID,
            'number'     => $pokedexNumber,
            'form'       => $form,
        ]);

        if ($pokedexRow !== false) {
            return;
        }

        $this->db->insert("pokedex_entries", [
            'id'          => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'number'      => $pokedexNumber,
            'form'        => $form,
            'date_added'  => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ]);
    }
}
