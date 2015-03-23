<?php

class SetGraphRelationship extends NeoEloquent
{
    public function setRelationship($data)
    {
        $product  = SetGraphProduct::findMany(array('keyName' => 'productId','value' => $data->productId));
        $client   = SetGraphClient::findMany(array('keyName' => 'clientId','value' => $data->clientId));

        return $product->relationshipType($data->relationshipType)->attach($client);
    }
}
