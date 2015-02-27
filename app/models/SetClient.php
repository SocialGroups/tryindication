<?php

class SetClient extends Eloquent
{
    public function client($data)
    {

        $user = SetGraphClient::create(

            array(

                'clientId'      => $data->clientId,
                'companyHash'   => $data->companyHash,
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