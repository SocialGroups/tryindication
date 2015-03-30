<?php

class RedisQueueIndications extends Eloquent
{

    public function setQueue($companyHash,$productId)
    {

        $redis = Redis::connection('queueindications');

        $value = json_encode(
            [
                'companyHash' => $companyHash,
                'productId' => $productId
            ]
        );

        $redis->set($companyHash.'_'.$productId,$value);

    }

}