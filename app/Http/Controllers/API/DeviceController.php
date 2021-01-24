<?php

namespace App\Http\Controllers\API;

use App\Models\Device;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Device\CreateRequest;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->seconds = 1440;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        /**
         * uid ve appid ye göre cache 'key' bilgisi kontrol edilir
         * kayıtlı bir client_token yoksa database'i kontrol eder
         * eğer orada da yoksa client_token boş dönecektir
        */
        $client_token = Cache::remember($request->uid. '-' . $request->appId, $seconds = $this->seconds, function () use ($request) {
            return Device::select('client_token')->where('uid', $request->uid)->where('appId', $request->appId)->value('client_token');
        });

        /**
         * client_token boş ise böyle bir kayıt daha önce yapılmamıştır
         * gelen veriler device tablosuna kaydedilir
         */
        if (!$client_token){
            $device = new Device;
            $device->uid = $request->uid;
            $device->appId = $request->appId;
            $device->language = $request->language;
            $device->operating_system = $request->operating_system;
            $device->client_token = $device->createClientToken();
            $device->save();

            //oluşturulan client_token uid ve appid ye göre cache'e kaydedilir
            Cache::put($request->uid . '-' . $request->appId, $device->client_token, $seconds = $this->seconds);
        }

        return response()->json(
            array(
                "result" => "true",
                "message" => "Register OK",
                "client_token" => $client_token?$client_token:$device->client_token
            ),
            200
        );
    }

}
