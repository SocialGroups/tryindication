<?php

class Testando extends NeoEloquent {

    protected $label = 'User'; // or array('User', 'Fan')

    protected $fillable = ['name', 'email'];
}

$user = Testando::create(['name' => 'Some Name', 'email' => 'some@email.com']);