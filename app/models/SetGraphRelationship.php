<?php

set_time_limit(0);

use RedisProcessingIndications\SetRedisProcessingQueue;
use Relationships\Data\Send;

class SetGraphRelationship extends NeoEloquent
{

    public function __construct()
    {

        $this->redis        = Redis::connection('queueIndications');
        $this->redisLast    = Redis::connection('lastVisualization');

    }

    public function dataValidate($type,$data,$dataId)
    {

        if($data == null){

            if($type == 'product'){

                return [

                    'response'  => 204,
                    'msg'       => "O $type: $dataId nao existe em nossa base de dados"

                ];

            }

            return [

                'response'  => 204,
                'msg'       => "O $type: $dataId nao existe em nossa base de dados"

            ];

        }

    }

    public function fire($job, $data)
    {

       foreach(json_decode($data['relationships']) as $relationshipData){

           $product  = SetGraphProduct::findMany(array('keyName' => 'productId','value' => $relationshipData->productId));

           $client   = SetGraphClient::find($relationshipData->clientId);

           if($product == null){

               return $this->dataValidate('product',$product,$relationshipData->productId);

           }

           if($client == null){

               return $this->dataValidate('client',$client,$relationshipData->clientId);

           }

           $product->relationshipType($relationshipData->relationshipType)->attach($client);

       }

        $job->delete();

    }

    public function getQueueData($companyHash)
    {

        return $this->redis->get($companyHash);

    }

    public function checkSetProcessingList($data,$queueRelationshipData)
    {

        if(COUNT($queueRelationshipData) >= 200){

            $processingRelationships = New Send();

            $processingRelationships->_prepareCollection(

                [

                'companyHash'       => $data->companyHash,
                'relationships'     => json_encode($queueRelationshipData)

                ]
            );

            return null;


           $this->redis->del($data->companyHash);

        }

        return $queueRelationshipData;

    }

    public function queueRelationship(Request\Relationship $data)
    {

        // seta produto na lista para processamento

        $setQueueProcessing = new SetRedisProcessingQueue();

        $setQueueProcessing->setIndication($data);

        // seta ultimo produto visualizado pelo cliente

        $this->redisLast->set($data->companyHash.'_'.$data->clientId,$data->productId);

        $queueRelationshipData = json_decode($this->getQueueData($data->companyHash));

        if(!$this->checkSetProcessingList($data,$queueRelationshipData)){

            $queueRelationshipData = [];

        }

        $queueRelationshipData[] = [
            'productId'             => $data->productId,
            'clientId'              => $data->clientId,
            'relationshipType'      => $data->relationshipType,
            'companyHash'           => $data->companyHash
        ];

        $this->redis->set($data->companyHash,json_encode($queueRelationshipData));

        return [

            'response'  => 'sucess',
            'msg'       => "Relacionamento criado com sucesso!"

        ];

    }

}