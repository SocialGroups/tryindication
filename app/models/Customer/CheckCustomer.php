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

    public function setSession($customerId)
    {

        \Session::put('customerSessionId'.'_'.$customerId, $customerId);

    }

    public function indication($customerId)
    {

        $this->setSession($customerId);

        $cacheCustomerId = $this->cacheCustomerRequest($customerId);

        if($cacheCustomerId){

            return [

                'auth'      => true,
                'response'  => $cacheCustomerId

            ];

        }

        $client   = SetGraphClient::find($customerId);

        if($client){

            $this->redis->set('customerId'.'_'.$customerId,$customerId);

            return [

                'auth'      => true,
                'response'  => $client->id

            ];

        }

        return [

            'auth'      => false,
            'response'  => 'Cliente nao existe'

        ];

    }

}