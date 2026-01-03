<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Обработка live матчей каждую секунду
Schedule::command('live-matches:process')
    ->everySecond()
    ->withoutOverlapping()
    ->runInBackground();

// Обработка товарищеских матчей каждый день в 00:00
Schedule::command('friendly-matches:process')
    ->daily()
    ->withoutOverlapping();

// Отправка напоминаний о матчах каждые 15 минут
Schedule::command('notifications:send-game-reminders')
    ->everyFifteenMinutes()
    ->withoutOverlapping();

// Обработка запланированных уведомлений каждые 5 минут
Schedule::command('notifications:process-scheduled')
    ->everyFiveMinutes()
    ->withoutOverlapping();

// Увеличение рейтинга фейковых пользователей (5-6 раз в день)
// Запускаем каждые 4 часа (6 раз в день)
Schedule::command('fake-users:increase-rating')
    ->everyFourHours()
    ->withoutOverlapping();
