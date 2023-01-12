<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\TemplateEngine;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetLogFoodDiary
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
    ) {}

    public function __invoke(): void
    {
        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");
        $yesterday = CarbonImmutable::yesterday(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");

        $todayRow = $this->db->fetchOne("SELECT * FROM log_food_diary WHERE instance_id = :instanceId AND date_logged = :dateLogged", [
            'instanceId' => INSTANCE_ID,
            'dateLogged' => "{$today} 12:00:00",
        ]);
        $yesterdayRow = $this->db->fetchOne("SELECT * FROM log_food_diary WHERE instance_id = :instanceId AND date_logged = :dateLogged", [
            'instanceId' => INSTANCE_ID,
            'dateLogged' => "{$yesterday} 12:00:00",
        ]);

        $isTodayLogged = $todayRow !== false;
        $isYesterdayLogged = $yesterdayRow !== false;

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/FoodDiary.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'isTodayLogged' => $isTodayLogged,
            'isYesterdayLogged' => $isYesterdayLogged,
            'errors' => $errors,
        ]);
    }
}
