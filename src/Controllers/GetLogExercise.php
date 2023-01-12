<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\TemplateEngine;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetLogExercise
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
    ) {}

    public function __invoke(): void
    {
        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");
        $yesterday = CarbonImmutable::yesterday(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");

        $todayRows = $this->db->fetchAllAssociative("SELECT * FROM log_exercise WHERE instance_id = :instanceId AND date_logged = :dateLogged", [
            'instanceId' => INSTANCE_ID,
            'dateLogged' => "{$today} 12:00:00",
        ]);
        $yesterdayRows = $this->db->fetchAllAssociative("SELECT * FROM log_exercise WHERE instance_id = :instanceId AND date_logged = :dateLogged", [
            'instanceId' => INSTANCE_ID,
            'dateLogged' => "{$yesterday} 12:00:00",
        ]);

        $loggedToday = count($todayRows);
        $loggedYesterday = count($yesterdayRows);

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Exercise.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'loggedToday' => $loggedToday,
            'loggedYesterday' => $loggedYesterday,
            'errors' => $errors,
        ]);
    }
}
