<?php

namespace App\Models\Reports;

class ReportCategory
{
    // Категории нарушений
    const CHEATING = 1;                    // Читы, использование уязвимостей
    const TOXIC_BEHAVIOR = 2;              // Токсичное поведение, оскорбления
    const SPAM = 3;                        // Спам, флуд
    const INAPPROPRIATE_CONTENT = 4;       // Неподходящий контент
    const ACCOUNT_SHARING = 5;             // Передача аккаунта третьим лицам
    const EXPLOITATION = 6;                // Эксплуатация багов системы
    const HARASSMENT = 7;                  // Преследование, домогательства
    const IMPERSONATION = 8;               // Выдача себя за другого пользователя
    const OTHER = 9;                       // Другое

    /**
     * Получить список всех категорий
     *
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::CHEATING => 'Читы и использование уязвимостей',
            self::TOXIC_BEHAVIOR => 'Токсичное поведение и оскорбления',
            self::SPAM => 'Спам и флуд',
            self::INAPPROPRIATE_CONTENT => 'Неподходящий контент',
            self::ACCOUNT_SHARING => 'Передача аккаунта третьим лицам',
            self::EXPLOITATION => 'Эксплуатация багов системы',
            self::HARASSMENT => 'Преследование и домогательства',
            self::IMPERSONATION => 'Выдача себя за другого пользователя',
            self::OTHER => 'Другое',
        ];
    }

    /**
     * Получить название категории по ID
     *
     * @param int $id
     * @return string|null
     */
    public static function getName(int $id): ?string
    {
        return self::getAll()[$id] ?? null;
    }
}


