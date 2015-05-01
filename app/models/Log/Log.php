<?php

namespace Log;

use Lukaskorl\Apigen\Fields\Date;

class Log
{

    private $redis;

    public function __construct()
    {

        $this->redis = \Redis::connection();

    }

    public function log($companyHash,$dataLog)
    {

        if($dataLog instanceof \Illuminate\Http\Request){

            $this->redis->set($companyHash.'_'.date('Y-m-d_H:i:s'), json_encode(

                [

                'request_uri'   => $dataLog->getUri(),
                'request'       => $dataLog->all()

                ]

            ));

        }

        if($dataLog instanceof \Illuminate\Http\Response){

            $this->redis->set($companyHash.'_'.date('Y-m-d_H:i:s'), json_encode(

                [

                    'content'       => $dataLog->getContent(),
                    'statusCode'    => $dataLog->getStatusCode()

                ]

            ));

        }

    }

}