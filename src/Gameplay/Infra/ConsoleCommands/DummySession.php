<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\ConsoleCommands;

use LogicException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;

final class DummySession implements FlashBagAwareSessionInterface
{
    public function getFlashBag(): FlashBagInterface
    {
        return new class implements FlashBagInterface
        {
            public function add(string $type, mixed $message)
            {
                //
            }

            public function get(string $type, array $default = []): array
            {
                return $default;
            }

            public function set(string $type, string|array $messages)
            {
                throw new LogicException();
            }

            public function peek(string $type, array $default = []): array
            {
                throw new LogicException();
            }

            public function peekAll(): array
            {
                throw new LogicException();
            }

            public function all(): array
            {
                throw new LogicException();
            }

            public function setAll(array $messages)
            {
                throw new LogicException();
            }

            public function has(string $type): bool
            {
                throw new LogicException();
            }

            public function keys(): array
            {
                throw new LogicException();
            }

            public function getName(): string
            {
                throw new LogicException();
            }

            public function initialize(array &$array)
            {
                throw new LogicException();
            }

            public function getStorageKey(): string
            {
                throw new LogicException();
            }

            public function clear(): mixed
            {
                throw new LogicException();
            }
        };
    }

    public function start(): bool
    {
        throw new LogicException();
    }

    public function getId(): string
    {
        throw new LogicException();
    }

    public function setId(string $id)
    {
        throw new LogicException();
    }

    public function getName(): string
    {
        throw new LogicException();
    }

    public function setName(string $name)
    {
        throw new LogicException();
    }

    public function invalidate(int $lifetime = null): bool
    {
        throw new LogicException();
    }

    public function migrate(bool $destroy = false, int $lifetime = null): bool
    {
        throw new LogicException();
    }

    public function save()
    {
        throw new LogicException();
    }

    public function has(string $name): bool
    {
        throw new LogicException();
    }

    public function get(string $name, mixed $default = null): mixed
    {
        throw new LogicException();
    }

    public function set(string $name, mixed $value)
    {
        throw new LogicException();
    }

    public function all(): array
    {
        throw new LogicException();
    }

    public function replace(array $attributes)
    {
        throw new LogicException();
    }

    public function remove(string $name): mixed
    {
        throw new LogicException();
    }

    public function clear()
    {
        throw new LogicException();
    }

    public function isStarted(): bool
    {
        throw new LogicException();
    }

    public function registerBag(SessionBagInterface $bag)
    {
        throw new LogicException();
    }

    public function getBag(string $name): SessionBagInterface
    {
        throw new LogicException();
    }

    public function getMetadataBag(): MetadataBag
    {
        throw new LogicException();
    }
}
