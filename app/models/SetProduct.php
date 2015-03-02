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
                'productStatus' => $data->productStatus,
                'productStatus' => $data->productName,
                'productStatus' => $data->productUrl

            )
        );

        $productAttributs = (object) $product->attributes;

        if($productAttributs->id) {

            return array('productId' => $productAttributs->id);

        }

        return array('error' => '205');

    }

    public function updateProduct($id,$data)
    {

        $product = SetGraphProduct::find($id);

        $product->companyHash   = $data->companyHash;
        $product->productId     = $data->productId;
        $product->productPrice  = $data->productPrice;
        $product->productImg    = $data->productImg;
        $product->productStatus = $data->productStatus;
        $product->productName   = $data->productName;
        $product->productUrl    = $data->productUrl;

        $product->update();

    }

}