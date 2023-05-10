<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

use Carbon\CarbonImmutable;
use GuzzleHttp\Client;

final class Clock
{
    public function isDay(): bool
    {
        $now = CarbonImmutable::now("Europe/Dublin");

        $response = (new Client())->get("https://api.sunrisesunset.io/json?lat=53.34981&lng=-6.26031&timezone=Europe%2FDublin&date=today");

        $data = json_decode($response->getBody()->getContents(), true);

        $sunrise = CarbonImmutable::createFromFormat(
            "Y-m-d g:i:s A",
            $now->format("Y-m-d ") . $data['results']['sunrise'],
            "Europe/Dublin"
        );
        $sunset = CarbonImmutable::createFromFormat(
            "Y-m-d g:i:s A",
            $now->format("Y-m-d ") . $data['results']['sunset'],
            "Europe/Dublin"
        );

        return $now->isAfter($sunrise) && $now->isBefore($sunset);
    }

    public function isNight(): bool
    {
        return !$this->isDay();
    }
}
