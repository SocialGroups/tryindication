<?php

namespace RedisProcessingIndications;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class Processing extends \Eloquent
{

    public function __construct()
    {

        $this->connection   = DB::connection('neo4j')->getClient();

        $this->redis        = \Redis::connection('queueIndicationsProcessing');

        // Instância classe responsável por gerar as indicações para um produto
        $this->setIndications = new \GetNeo4jIndications();

    }

    public function indication()
    {

        foreach($this->redis->keys('*') as $queueKey){

            $queueData = json_decode($this->redis->get($queueKey));

            $this->setIndications->indication($queueData->companyHash,$queueData->productId);

            $this->redis->del($queueKey);

        }

    }

}