<?php

namespace Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use SetGraphClient;

class CheckCustomer extends \Eloquent
{

    public function __construct()
    {

        $this->connection   = DB::connection('neo4j')->getClient();

        $this->redis        = \Redis::connection();

    }

    public function cacheCustomerRequest($customerId)
    {

        return $this->redis->get('customerId'.'_'.$customerId);

    }

    public function indication($customerId)
    {

        $cacheCustomerId = $this->cacheCustomerRequest($customerId);

        if($cacheCustomerId){

            return [

                'auth'      => true,
                'code'      => 200,
                'response'  => $cacheCustomerId

            ];

        }

        $client = SetGraphClient::find($customerId);

        if($client){

            $this->redis->set('customerId'.'_'.$customerId,$customerId);

            return [

                'auth'      => true,
                'code'      => 200,
                'response'  => $client->id

            ];

        }

        return [

            'auth'      => false,
            'code'      => 404,
            'response'  => 'Cliente nao existe'

        ];

    }

}