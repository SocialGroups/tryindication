<?php

class SetProduct extends Eloquent
{

    public function updateProduct($id, Request\Product $data)
    {

        $product = SetGraphProduct::findMany(array('keyName' => 'productId','value' => $id));

        if($product){

            $product->companyHash   = $data->companyHash;
            $product->productId     = $data->productId;
            $product->productPrice  = $data->productPrice;
            $product->productImg    = $data->productImg;
            $product->productStatus = $data->productStatus;
            $product->productName   = $data->productName;
            $product->productUrl    = $data->productUrl;

            $product->update();

            return array(
                'productId' => $id,
                'response' => 'sucess'
            );

        }

        return [
            'productId' => $id,
            'response'  => 'error',
            'msg'       => 'the product can not be updated because it does not exist in our database'
        ];
    }
}
