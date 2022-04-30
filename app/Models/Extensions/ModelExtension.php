<?php

namespace App\Models\Extensions;

/**
 * @method static static create(array $attributes = [])
*/
trait ModelExtension
{
    /**
     * Получить имя таблицы
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static())->getTable();
    }
}
