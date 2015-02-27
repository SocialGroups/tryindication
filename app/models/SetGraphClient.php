<?php

class SetGraphClient extends NeoEloquent {

    protected $label = 'client';

    protected $fillable = ['clientId','companyHash', 'clientEmail'];
}