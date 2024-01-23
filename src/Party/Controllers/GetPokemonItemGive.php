<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemGiveActionVm;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemUseActionVm;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemVm;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPokemonItemGive
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly BagRepository $bagRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonId = $args['id'];

        $pokemon = $this->pokemonRepository->find($pokemonId);
        $bag = $this->bagRepository->find();

        $itemViewModels = [];

        foreach ($bag->items as $item) {
            $configEntry = $this->itemConfigRepository->find($item->id);

            if (!array_key_exists('type', $configEntry)
                || $configEntry['type'] !== ItemType::HELD
            ) {
                continue;
            }

            $itemViewModels[] = new BagItemVm(
                $item->id,
                $configEntry['name'],
                $configEntry['imageUrl'],
                strval($item->quantity),
                array_key_exists('hasUse', $configEntry)
                && $configEntry['hasUse'],
                new BagItemUseActionVm(
                    "/{$instanceId}/party/use/{$item->id}",
                    [
                        'pokemon'         => $pokemonId,
                        'redirectUrlPath' => "/{$instanceId}/party/member/{$pokemonId}/item-use",
                    ],
                ),
                true,
                new BagItemGiveActionVm(
                    "/{$instanceId}/party/give/{$item->id}",
                    [
                        'pokemon'         => $pokemonId,
                        'redirectUrlPath' => "/{$instanceId}/party/member/{$pokemonId}/item-give",
                    ],
                ),
            );
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/PokemonItemGive.php", [
            'pokemon' => Pokemon::create($pokemon),
            'items'   => $itemViewModels,
        ]));
    }
}