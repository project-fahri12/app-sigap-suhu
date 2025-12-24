<?php

namespace App\Services\Ppdb;

use Midtrans\Config;
use Midtrans\Snap;
use Exception;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken($params)
    {
        return Snap::getSnapToken($params);
    }

    public function verifySignature($orderId, $statusCode, $grossAmount, $signatureKey)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
        return $hashed === $signatureKey;
    }
}