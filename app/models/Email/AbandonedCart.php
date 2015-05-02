<?php

namespace Email;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Mail;

class AbandonedCart extends \Eloquent
{

    public function __construct()
    {

        $this->redis = \Redis::connection();

    }

    public function sendData($sendData,$dataIndications,$clientEmail)
    {

        $clientName     = $sendData->clientName;
        $productName    = $sendData->productName;
        $companyName    = $sendData->companyName;

        Mail::send('emails.hello', array('productData' => $dataIndications), function($message) use ($clientEmail,$clientName,$productName,$companyName)
        {

            $message->from('lucas.santos@e-smart.com.br', $companyName);

            $message->to($clientEmail, $clientName)
                ->subject("Olá $clientName, o {$productName} que você gostou está em promoção!");
        });

    }

    public function fire($job, $data)
    {

        $sendData           = json_decode($data['data']);

        $dataIndications    = json_decode($this->redis->get($sendData->companyHash.'_'.$sendData->productId));

        $clientEmail        = $sendData->clientEmail;

        $this->sendData($sendData,$dataIndications,$clientEmail);

        $job->delete();

    }

    public function setQueue($data)
    {

        Queue::push('Email\AbandonedCart',

            [
                'data'       => json_encode([

                    'companyHash'   => $data->companyHash,
                    'companyName'   => $data->companyName,
                    'clientEmail'   => $data->clientEmail,
                    'clientName'    => $data->clientName,
                    'productId'     => $data->productId,
                    'productName'   => $data->productName

                ])
            ]
        );


        return [

            'response'  => 'sucess',
            'msg'       => "E-Mail enviado para fila de processamento!"

        ];

    }

}