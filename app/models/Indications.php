<?php

class Indications extends Eloquent
{

    public function __construct()
    {

        $this->redis = Redis::connection();

    }

    public function get($companyHash,$productId)
    {

        $indications = json_decode($this->redis->get($companyHash.'_'.$productId));

        if($indications){

            return json_encode([

                'response'  => 'sucess',
                'code'      => 200,
                'data'      => $indications

            ],true);

        }

        return json_encode([

                    'response'  => 'error',
                    'code'      => 404

                ],true);

    }

}