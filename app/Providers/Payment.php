<?php

namespace App\Providers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Http;

class Payment {

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    
    public function execute($amount, $category) {
        $now = Carbon::now();
        $merchantOrderId = $now->getPreciseTimestamp(3);
        $payload = [
            "return_url" => "https://nrssportsfoundation.org.np/khalti-redirect/", 
            "website_url" => "https://nrssportsfoundation.org.np/",
            "amount" => $amount * 100,
            "purchase_order_id" => $merchantOrderId,
            "purchase_order_name" => $category,
        ];
        
        $response = $this->client->request('POST','https://khalti.com/api/v2/epayment/initiate/', [
            'headers' => [
                'Authorization' => 'Key live_secret_key_1878b081affd4b7fb39444c3bfd947ee',
                'Content-Type' => 'application/json',
                'Format' => 'application/json',
            ],
            'json' => $payload
        ]);
        
        if($response->getStatusCode() == 200){
            return $response->getBody()->getContents();
        }else{
            dd("error");
        }
    }

    public function paymentVerificationLookUp($pidx) {
        $payload = [
            'pidx' => $pidx
        ];
        $response = $this->client->request('POST', 'https://khalti.com/api/v2/epayment/lookup/', [
            'headers' => [
                'Authorization' => 'Key live_secret_key_1878b081affd4b7fb39444c3bfd947ee',
                'Format' => 'application/json',
            ],
            'json' => $payload
        ]);
        return $response->getBody()->getContents();
    }
}