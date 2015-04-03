<?php

use RedisProcessingIndications\SetRedisProcessingQueue;

class SetGraphRelationship extends NeoEloquent
{

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

        $job->delete();

        $product  = SetGraphProduct::findMany(array('keyName' => 'productId','value' => $data['productId']));

        $client   = SetGraphClient::find($data['clientId']);

        if($product == null){

            return $this->dataValidate('product',$product,$data['productId']);

        }

        if($client == null){

            return $this->dataValidate('client',$client,$data['clientId']);

        }

        $product->relationshipType($data['relationshipType'])->attach($client);

    }

    public function queueRelationship(Request\Relationship $data)
    {

        // seta produto na lista para processamento
        $setQueueProcessing = new SetRedisProcessingQueue();
        $setQueueProcessing->setIndication($data);

        Queue::push('SetGraphRelationship',

            [
                'productId'             => $data->productId,
                'clientId'              => $data->clientId,
                'relationshipType'      => $data->relationshipType,
                'companyHash'           => $data->companyHash
            ]
        );

        return [

            'response'  => 'sucess',
            'msg'       => "Relacionamento criado com sucesso!"

        ];

    }

}