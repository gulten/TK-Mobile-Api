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
        return bin2hex(random_bytes(64));
        /* burada üretilen karakter dizisinin benzzersiz olması önemli
        *  önlem olarak başka yöntemler de eklenebilir
        *  her üretim sonunda tablo içerisinde bu client_token ile kayıtlı bir satır olup olmadığı kontrol edilebilir
        */

    }
}
