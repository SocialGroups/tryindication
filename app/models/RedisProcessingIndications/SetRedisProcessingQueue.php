<?php

namespace RedisProcessingIndications;
use RedisProcessingIndications\Processing;

class SetRedisProcessingQueue extends \Eloquent
{

    public function setIndication($data)
    {

        $processingData = json_encode([

            'companyHash'       => $data->companyHash,
            'productId'         => $data->productId

        ],true);

        $redis = \Redis::connection('queueIndicationsProcessing');

        $redis->set($data->companyHash.'_'.$data->productId,$processingData);

    }

}