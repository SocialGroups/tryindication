<?php

class SetGraphRelationship extends NeoEloquent
{

    public function dataValidate($type,$data,$dataId)
    {

        if($data == null){

            if($type == 'product'){

                return [

                    'response'  => 400,
                    'msg'       => "O $type: $dataId nao existe em nossa base de dados"

                ];

            }

            return [

                'response'  => 400,
                'msg'       => "O $type: $dataId nao existe em nossa base de dados"

            ];

        }

    }

    public function setRelationship(Request\Relationship $data)
    {

        $product  = SetGraphProduct::findMany(array('keyName' => 'productId','value' => $data->productId));

        $client   = SetGraphClient::find($data->clientId);

        if($product == null){

            return $this->dataValidate('product',$product,$data->productId);

        }

        if($client == null){

            return $this->dataValidate('client',$client,$data->clientId);

        }

        $product->relationshipType($data->relationshipType)->attach($client);

        return [

            'response'  => 'sucess',
            'msg'       => "Relacionamento criado com sucesso!"

        ];

    }

}