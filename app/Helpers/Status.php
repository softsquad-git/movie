<?php

namespace App\Helpers;

class Status
{
    public const OFF = 0;
    public const ON = 1;
    public const WAITING = 2;
    public const LOCKED = 3;

    /**
     * @param int $statusCode
     * @return string|null
     */
    public static function getNameStatus(int $statusCode): ?string
    {
        switch ($statusCode) {
            case 0:
                return 'No active';
                break;
            case 1:
                return 'Active';
                break;
            case 2:
                return 'Waiting';
                break;
            case 3:
                return 'Locked';
                break;
            default:
                return null;
                break;
        }
    }
}
