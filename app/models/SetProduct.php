<?php

class SetProduct extends Eloquent
{
    public function setIndication($data)
    {

        $user = SetGraphProduct::create(

            array(

                'companyHash'   => $data->companyHash,
                'productId'     => $data->productId,
                'productPrice'  => $data->productPrice,
                'productImg'    => $data->productImg

            )
        );

    }


}