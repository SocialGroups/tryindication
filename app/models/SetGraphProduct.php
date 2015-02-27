<?php

class SetGraphProduct extends NeoEloquent {

    protected $label = 'product';

    protected $fillable = ['companyHash', 'productId', 'productPrice', 'productImg'];

    public function relationshipType($relationshipType)
    {
        return $this->belongsToMany('SetGraphProduct', $relationshipType);
    }

}