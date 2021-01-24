<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use App\Http\Requests\FakeService\PurchaseRequest;

class Helpers {
    public static function oddControl($param)
    {
        return (int) Str::substr($param, -1) & 1;
    }

    public static function getDateUTC()
    {
        return (new DateTime())->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d H:i:s');
    }
}
