<?php

class SetClient extends Eloquent
{
    public function client($data)
    {

        $user = SetGraphClient::create(

            array(

                'companyHash'   => $data->companyHash,
                'clientId'      => $data->clientId,
                'clientEmail'   => $data->clientEmail

            )
        );

    }


}