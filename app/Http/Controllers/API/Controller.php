<?php

namespace App\Http\Controllers\API;

class Controller
{
    /**
     * @OA\Info(title="Tk Mobile API", version="0.1")
     */

    /**
     * @OA\Post(
     *     path="/api/devices",
     *      summary="DeviceController@store",
     *      description="Cihaz Eklemek İçin Kullanılır",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"uid","appId","language","operating_system"},
     *                  @OA\Property(
     *                      property="uid",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="appId",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="language",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="operating_system",
     *                      type="string",
     *                  ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Failed",
     *      ),
     * )
     */


    /**
     * @OA\Post(
     *     path="/api/subscriptions",
     *      summary="SubscriptionController@store",
     *      description="Abonelik Eklemek veya Güncellemek İçin Kullanılır",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"client_token","receipt","service","third_party_url"},
     *                  @OA\Property(
     *                      property="client_token",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="receipt",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="service",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="third_party_url",
     *                      type="string",
     *                  ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Failed",
     *      ),
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/subscriptions",
     *      summary="SubscriptionController@checkSubscription",
     *      description="Abonelik Kontrolü İçin Kullanılır",
     *      @OA\Parameter(
     *          name="client_token",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Failed",
     *      ),
     * )
     */
}
