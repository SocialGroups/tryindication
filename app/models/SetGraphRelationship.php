<?php

class SetGraphRelationship extends NeoEloquent
{

    public function setRelationship($data)
    {

        $product  = SetGraphProduct::find($data->productId);

        $client   = SetGraphClient::find($data->clientId);

        return $product->relationshipType($data->relationshipType)->attach($client);

    }

}