<?php

class SetGraphProduct extends NeoEloquent {

    protected $label = 'product';

    protected $fillable = ['companyHash', 'productId', 'productPrice', 'productImg'];

    public function viewed()
    {
        return $this->belongsToMany('SetGraphProduct', 'VIEWED');
    }

    public function bought()
    {
        return $this->belongsToMany('SetGraphProduct', 'bought');
    }

}