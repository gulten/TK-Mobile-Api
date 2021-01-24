<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helpers;
use App\Models\Device;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\CheckRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Subscription\CreateRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
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
         * istek yapan client_token cache'de kayıtlı değilse database'i kontrol eder
         * eğer orada da yoksa böyle bir cihaz register olmamıştır
         */
        $device_id = Cache::remember($request->client_token, $seconds = $this->seconds, function () use ($request) {
            return Device::select('id')->where('client_token', $request->client_token)->value('id');
        });

        /**
         * device bulunamadıysa response dön
         */
        if(!$device_id) {
            return response()->json(
                array(
                    "result" => "false",
                    "message" => "Cihaz Bulunamadı"
                ),
                400
            );
        }

        /**
         * config/service aracılığı ile service endpoint değeri elde ediliyor
         */
        $end_point = config('services.' . $request->service . '.endpoint');

        /**
         * receipt kontrol edilerek fake response oluşturuluyor
         */
        if (Helpers::oddControl($request->receipt)){
                 Http::fakeSequence()
                    ->push(['result' => 'true', 'message' => 'OK', 'status' => 'true', 'expire_date' => Helpers::getDateUTC()], 200)
                    ->whenEmpty(Http::response());
        }
        else {
            Http::fake(function ($request) {
                return Http::response(['result' => 'false', 'message' => 'FAIL', 'status' => 'false'], 400);
            });
        }

        /**
         * fake servis request atılıyor
         */
        $response = Http::withHeaders([
            'username' => config('services.' . $request->service . '.user'),
            'password' => config('services.' . $request->service . '.password')
        ])->post($end_point, [
            'client_token' => $request->client_token,
            'receipt' => $request->receipt,
        ]);

        /**
         * abonelik isteği başarılı ise
         * client_token ile device id ye ulaşılıyor
         */
        if ($response['message'] == 'OK') {
            Subscription::updateOrCreate(
                ['device_id' => $device_id],
                [
                    'status' => $response[ 'status'],
                    'expire_date ' => $response[ 'expire_date'],
                    'service' => $request->service,
                    'third_party_url' => $request->third_party_url
                ]
            );
            return response()->json(
                array(
                    "result" => "true",
                    "message" => "İşlem Gerçekleştirildi"
                ),
                200
            );
        }

        return response()->json(
            array(
                "result" => "false",
                "message" => "İşlem Gerçekleştirilemedi"
            ),
            400
        );

    }


    public function checkSubscription(CheckRequest $request)
    {
        /**
         * istek yapan client_token cache'de kayıtlı değilse database'i kontrol eder
         * eğer orada da yoksa böyle bir cihaz register olmamıştır
         */
        $device_id = Cache::remember($request->client_token, $seconds = $this->seconds, function () use ($request) {
            return Device::select('id')->where('client_token', $request->client_token)->value('id');
        });

        /**
         * device bulunamadıysa response dön
         */
        if (!$device_id) {
            return response()->json(
                array(
                    "result" => "false",
                    "message" => "Cihaz Bulunamadı"
                ),
                400
            );
        }

        $subscription = Subscription::select('status', 'expire_date')->where('device_id', $device_id)->first();

        if ($subscription) {
            return response()->json(
                array(
                    "result" => "true",
                    "message" => $subscription
                ),
                200
            );
        }
        else{
            return response()->json(
                array(
                    "result" => "false",
                    "message" => "Abonelik kaydı bulunamadı"
                ),
                400
            );
        }

    }

}
