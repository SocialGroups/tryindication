<?php

class SetProduct extends Eloquent
{
    public function createProductNode(Request\Product $data)
    {
        $product = SetGraphProduct::create(
            [
                'productId'     => $data->id,
                'companyHash'   => $data->companyHash,
                'productPrice'  => $data->price,
                'productImg'    => $data->img,
                'productStatus' => $data->status
            ]
        );

        $productAttributes = (object) $product->attributes;

        if ($productAttributes->id) {
            return ['productId' => $productAttributes->id];
        }

        return ['error' => '205'];
    }

}