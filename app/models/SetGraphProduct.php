<?php

class SetGraphProduct extends NeoEloquent {

    protected $label = 'product';

    protected $fillable = ['productId','companyHash', 'productPrice', 'productImg', 'productStatus'];

    public function relationshipType($relationshipType)
    {
        return $this->belongsToMany('SetGraphProduct', $relationshipType);
    }

}