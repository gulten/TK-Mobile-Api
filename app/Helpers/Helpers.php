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
}
