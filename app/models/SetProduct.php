<?php

class SetProduct extends Eloquent
{
    public function createProductNode(Request\Product $data)
    {

        $product = SetGraphProduct::create(
            [
                'productId'     => $data->productId,
                'companyHash'   => $data->companyHash,
                'productPrice'  => $data->productPrice,
                'productImg'    => $data->productImg,
                'productStatus' => $data->productStatus,
                'productName'   => $data->productName,
                'productUrl'    => $data->productUrl
            ]
        );

        $productAttributes = (object) $product->attributes;

        if ($productAttributes->id) {
            return ['productId' => $productAttributes->id];
        }

        return ['error' => '205'];
    }

    public function updateProduct($id,Request\Product $data)
    {

        $product = SetGraphProduct::findMany(array('keyName' => 'productId','value' => $id));

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