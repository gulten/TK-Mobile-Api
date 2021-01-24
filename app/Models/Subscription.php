<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'status', 'expire_date', 'service', 'third_party_url'];

    protected $table = 'subscription';

    public $timestamps = false;
}
