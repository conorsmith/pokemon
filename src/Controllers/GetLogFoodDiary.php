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

        $rows = $this->db->fetchAllAssociative("SELECT * FROM log_food_diary WHERE instance_id = :instanceId ORDER BY date_logged DESC", [
            'instanceId' => INSTANCE_ID,
        ]);

        $loggedDates = array_map(
            fn(array $row) => CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged']),
            $rows
        );

        $isTodayLogged = $todayRow !== false;
        $isYesterdayLogged = $yesterdayRow !== false;

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/FoodDiary.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'isTodayLogged' => $isTodayLogged,
            'isYesterdayLogged' => $isYesterdayLogged,
            'streak' => self::calculateStreak($loggedDates),
            'errors' => $errors,
        ]);
    }

    private function calculateStreak(array $dates): int
    {
        /** @var CarbonImmutable $latestDate */
        $latestDate = array_shift($dates);

        if (!$latestDate->isToday() && !$latestDate->isYesterday()) {
            return 0;
        }

        $streak = 1;

        /** @var CarbonImmutable $date */
        foreach ($dates as $date) {
            if ($date->diffInDays($latestDate) !== 1) {
                return $streak;
            }

            $streak++;
            $latestDate = $date;
        }

        return $streak;
    }
}
