<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['uid', 'appId', 'language', 'operating_system', 'client_token'];

    protected $table = 'device';

    public $timestamps = false;

    public function createClientToken() //Benzersiz bir client_token oluştur
    {
        return $this->attributes['uid'] . '-' . $this->attributes['appId']  . '-' .  (string) Str::uuid();
    }
}
