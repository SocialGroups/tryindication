<?php

class SetClient extends Eloquent
{
    public function client(Request\Client $data)
    {
        $user = SetGraphClient::create([
            'clientId'      => $data->clientId,
            'companyHash'   => $data->companyHash,
            'clientName'    => $data->clientName,
            'clientEmail'   => $data->clientEmail
        ]);

        $userAttributes = (object) $user->attributes;

        if ($userAttributes->id) {
            return array('userId' => $userAttributes->id);
        }

        return array('error' => '205');
    }
}
