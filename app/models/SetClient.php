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

    public function teste()
    {

        $jd = SetGraphProduct::find(2);
        $mc = SetGraphClient::find(4);

        $jd->viewed()->attach($mc);

    }


}