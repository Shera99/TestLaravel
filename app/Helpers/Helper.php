<?php

namespace App\Helpers;

use App\Enums\UserRole;

class Helper
{
    public static function getProjectStatusText(string $status): array
    {
        $texts = [
            'in_operation' => ['text' => 'В работе', 'class' => 'text-bg-primary'],
            'closed_successfully' => ['text' => 'Закрыт успешно', 'class' => 'text-bg-success'],
            'closed_not_successfully' => ['text' => 'Закрыт не успешно', 'class' => 'text-bg-danger']
        ];

        return $texts[$status];
    }

    public static function getRoleText(string $role): string
    {
        $texts = [
            'full_access' => 'Полный доступ',
            'editing' => 'Редактирование',
            'reading' => 'Просмотр'
        ];

        return $texts[$role];
    }

    public static function accessProjectEdit(string $role): bool
    {
        return $role != UserRole::READING->value;
    }

    public static function accessProjectMember(string $role): bool
    {
        return $role == UserRole::FULL_ACCESS->value;
    }
}
