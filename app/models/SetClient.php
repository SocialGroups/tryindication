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

    }


}