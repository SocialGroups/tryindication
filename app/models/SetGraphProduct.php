<?php

class SetGraphProduct extends NeoEloquent {

    protected $label = 'product';

    protected $fillable = ['productId','companyHash', 'productPrice', 'productImg', 'productStatus','productName','productUrl'];

    public function productId()
    {
        return $this->belongsTo('SetGraphProduct');
    }

    public function relationshipType($relationshipType)
    {
        return $this->belongsToMany('SetGraphProduct', $relationshipType);
    }

}