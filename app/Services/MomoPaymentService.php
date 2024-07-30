<?php

namespace App\Services;
class MomoPaymentService
{
    protected $partnerCode;
    protected $accessKey;
    protected $secretKey;
    protected $endpoint;

    public function __construct()
    {
        $this->partnerCode = config('momo.partner_code');
        $this->accessKey = config('momo.access_key');
        $this->secretKey = config('momo.secret_key');
        $this->endpoint = config('momo.endpoint');
    }

    public function createPayment($orderInfo, $amount, $orderId, $returnUrl, $notifyUrl)
    {
        $requestId = time() . "";
        $rawHash = "partnerCode=" . $this->partnerCode . "&accessKey=" . $this->accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyUrl;
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'accessKey' => $this->accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => '',
            'requestType' => 'captureMoMoWallet',
            'signature' => $signature,
        ];

        $result = $this->execute($data);
        //dd($result);
        return $result;
    }

    protected function execute($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
    
}
