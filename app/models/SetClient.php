<?php

class SetClient extends Eloquent
{
    public function client(Request\Client $data)
    {

        $user = SetGraphClient::create(

            [
                'companyHash'   => $data->companyHash,
                'clientName'    => $data->clientName,
                'clientEmail'   => $data->clientEmail
            ]

        );

        $userAttributs = (object) $user->attributes;

        if($userAttributs->id) {

            return [

                'response'  => 'sucess',
                'clientId'  => $userAttributs->id,

            ];

        }

        return array('error' => '205');

    }


}