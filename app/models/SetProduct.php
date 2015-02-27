<?php

class SetProduct extends Eloquent
{
    public function createProduct($data)
    {

        $product = SetGraphProduct::create(

            array(

                'productId'     => $data->productId,
                'companyHash'   => $data->companyHash,
                'productPrice'  => $data->productPrice,
                'productImg'    => $data->productImg,
                'productStatus' => $data->productStatus

            )
        );

        $productAttributs = (object) $product->attributes;

        if($productAttributs->id) {

            return array('productId' => $productAttributs->id);

        }

        return array('error' => '205');

    }

}