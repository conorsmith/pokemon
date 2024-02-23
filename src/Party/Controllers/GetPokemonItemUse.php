<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemGiveActionVm;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemUseActionVm;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemVm;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPokemonItemUse
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
        $evolutionItemViewModels = [];
        $heldItemViewModels = [];
        $statsItemViewModels = [];

        foreach ($bag->items as $item) {
            $configEntry = $this->itemConfigRepository->find($item->id);

            if (!array_key_exists('hasUse', $configEntry)
                || !$configEntry['hasUse']
            ) {
                continue;
            }

            $itemViewModel = new BagItemVm(
                $item->id,
                $configEntry['name'],
                $configEntry['imageUrl'],
                strval($item->quantity),
                true,
                new BagItemUseActionVm(
                    "/{$instanceId}/party/use/{$item->id}",
                    [
                        'pokemon'         => $pokemonId,
                        'redirectUrlPath' => "/{$instanceId}/party/member/{$pokemonId}/item-use",
                    ],
                ),
                false,
                new BagItemGiveActionVm(
                    "/{$instanceId}/party/give/{$item->id}",
                    [
                        'pokemon'         => $pokemonId,
                        'redirectUrlPath' => "/{$instanceId}/party/member/{$pokemonId}/item-give",
                    ],
                ),
            );
            
            match ($configEntry['type'] ?? null) {
                ItemType::EVOLUTION => $evolutionItemViewModels[] = $itemViewModel,
                ItemType::HELD      => $heldItemViewModels[] = $itemViewModel,
                ItemType::STATS     => $statsItemViewModels[] = $itemViewModel,
                default             => $itemViewModels[] = $itemViewModel,
            };
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/PokemonItemUse.php", [
            'pokemon'        => Pokemon::create($pokemon),
            'items'          => $itemViewModels,
            'evolutionItems' => $evolutionItemViewModels,
            'heldItems'      => $heldItemViewModels,
            'statsItems'     => $statsItemViewModels,
        ]));
    }
}
