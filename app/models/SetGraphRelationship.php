<?php

class SetGraphRelationship extends NeoEloquent
{

    public function getType($type)
    {

        switch ($type) {
            case 'viewed':
                return 'viewed';
                break;
            case 'bought':
                return 'bought';
                break;
            default:
                return false;
        }

    }

    public function setRelationship($data)
    {

        $product    = SetGraphProduct::find($data->productId);

        $client     = SetGraphClient::find($data->clientId);

        if($this->getType($data->relationshipType == 'viewed')) {

           return $product->viewed()->attach($client);

        }

        return $product->bought()->attach($client);

    }

}