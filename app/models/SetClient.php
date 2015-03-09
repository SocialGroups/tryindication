<?php

class SetClient extends Eloquent
{
    public function client(Request\Client $data)
    {

        $user = SetGraphClient::create(

            array(

                'clientId'      => $data->clientId,
                'companyHash'   => $data->companyHash,
                'clientName'    => $data->clientName,
                'clientEmail'   => $data->clientEmail

            )
        );

        $userAttributs = (object) $user->attributes;

        if($userAttributs->id) {

            return array('userId' => $userAttributs->id);

        }

        return array('error' => '205');

    }


}