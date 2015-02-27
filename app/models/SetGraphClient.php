<?php

class SetGraphClient extends NeoEloquent {

    protected $label = 'client';

    protected $fillable = ['companyHash', 'clientId', 'clientEmail'];
}