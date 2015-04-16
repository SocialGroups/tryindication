<?php

namespace Email;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class AbandonedCart extends \Eloquent
{

    public function __construct()
    {

        $this->redis = \Redis::connection();

    }

    public function sendData($sendData,$dataIndications,$clientEmail)
    {

        \Mail::send('emails.hello', array('productData' => $dataIndications), function($message) use ($clientEmail)
        {

            $message->from('lucas.santos@e-smart.com.br', 'Lucas Santos');

            $message->to($clientEmail, 'Lucas Santos')
                ->subject('funcinando 100% maluke');
        });

    }

    public function fire($job, $data)
    {

        $sendData        = json_decode($data['data']);

        $dataIndications = json_decode($this->redis->get($sendData->companyHash.'_'.$sendData->productId));

        $clientEmail = $sendData->clientEmail;

        $this->sendData($sendData,$dataIndications,$clientEmail);

        $job->delete();

    }

    public function setQueue($data)
    {

        \Queue::push('Email\AbandonedCart',

            [
                'data'       => json_encode([

                    'companyHash'   => $data->companyHash,
                    'clientEmail'   => $data->clientEmail,
                    'productId'     => $data->productId


                ])
            ]
        );


        return [

            'response'  => 'sucess',
            'msg'       => "E-Mail enviado para fila de processamento!"

        ];

    }

}